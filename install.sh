#!/bin/sh
RUNFOLDER=$(pwd)
FILE="/var/www/rcprovisioning/.installed"
INSTALL_FOLDER="/var/www/rcprovisioning"

# Check that the root user is running this script
if [[ $EUID -ne 0 ]]; then
   echo "This script must be run as root!" 
   exit 1
fi

# Check if the application has already installed or not.
if [ -f $FILE ]; then
    echo "This application has already installed!" 
    exit 1
fi

clear

echo ""
echo "############################################################"
echo "R-Cooker Provisioning system installer"
echo "############################################################"
echo ""

echo "[1/8] Installing system dependencies..."

apt-get install -yq nginx php php-{fpm,cli,common,mysql,pgsql,sqlite3,curl,gd,mbstring,xml,zip,bcmath,intl,readline,tokenizer,opcache} dnsmasq composer libusb-1.0-0-dev pkg-config build-essential git-core rsync libncurses-dev unzip python bc
curl -fsSL https://deb.nodesource.com/setup_24.x | bash >> /dev/null
apt-get install -yq nodejs

echo ""
echo "[2/8] Configure system settings..."

# Change PHP.ini file values
sed 's/post_max_size = 8M/post_max_size = 8G/' /etc/php/8.4/fpm/php.ini >> /dev/null
sed 's/upload_max_filesize = 2M/upload_max_filesize = 8G/' /etc/php/8.4/fpm/php.ini >> /dev/null
sed 's/max_execution_time = 30/max_execution_time = 120/' /etc/php/8.4/fpm/php.ini >> /dev/null

# Configure eth1
nmcli con mod "Wired connection 2" ipv4.addresses 172.20.0.1/24 ipv4.method manual
nmcli con up "Wired connection 2"

# Create and configure composer and node folders
mkdir -p /var/www/.npm
chown -R 33:33 /var/www/.npm

# Copying rcprovisiong permission file to sudoers folder 
cp -f $RUNFOLDER/configs/010_rcprovisioning /etc/sudoers.d/010_rcprovisioning

echo ""
echo "[3/8] Installing Raspberry PIs rpiboot application..."

cd $RUNFOLDER/rpiboot
make >> /dev/null
make install >> /dev/null
cd $RUNFOLDER

echo ""
echo "[4/8] Installing provisioning application files..."

mkdir -p $INSTALL_FOLDER
cp -rf $RUNFOLDER/app/* $INSTALL_FOLDER/
chown -R 33:33 $INSTALL_FOLDER

# Go application folder for following steps
cd $INSTALL_FOLDER

echo ""
echo "[5/8] Installing composer and node dependencies..."

su www-data -s composer install --no-dev >> /dev/null
su www-data -s n npm install >> /dev/null

echo ""
echo "Compling app scripts and stylesheets files..."

su www-data -s npm run build >> /dev/null

echo ""
echo "[6/8] Installing application configuration files..."

su www-data -s cp .env.production.example .env >> /dev/null
su www-data -s php artisan key:generate >> /dev/null
su www-data -s php artisan migrate --seed >> /dev/null

# Go back starting folder
cd $RUNFOLDER

echo ""
echo "[7/8] Installing configuration files..."

# Copy nginx configuration file to /etc/nginx/sites-available/default
cp -f $RUNFOLDER/configs/nginx-default /etc/nginx/sites-available/default

echo ""
echo "[8/8] Installing services and starting them..."

# Copying systemd services
cp -f $RUNFOLDER/systemd/rcprovisioning-dnsmasq.service /etc/systemd/system/rcprovisioning-dnsmasq.service
cp -f $RUNFOLDER/systemd/rcprovisioning-queue.service /etc/systemd/system/rcprovisioning-queue.service
cp -f $RUNFOLDER/systemd/rcprovisioning-rpiboot.service /etc/systemd/system/rcprovisioning-rpiboot.service

# Enabling services and starting them
systemctl enable --now rcprovisioning-dnsmasq.service >> /dev/null
systemctl enable --now rcprovisioning-queue.service >> /dev/null
systemctl enable --now rcprovisioning-rpiboot.service >> /dev/null

# Restart nginx and php
systemctl restart nginx >> /dev/null
systemctl restart php-fpm >> /dev/null

# Create installed file to prevent installation again
touch $FILE

echo ""
echo "Done!"
echo ""
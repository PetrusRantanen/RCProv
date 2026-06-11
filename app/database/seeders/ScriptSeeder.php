<?php

namespace Database\Seeders;

use App\Models\Script;
use Illuminate\Database\Seeder;

class ScriptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        /* This script resizes the ext4 partition on the device to use all available space on the storage medium.
        /* It uses parted to resize the second partition (which is typically the root partition) and then uses resize2fs to resize the filesystem to fit the new partition size.
        /* This is typically used after the initial installation of the operating system to ensure that the device can utilize all available storage space.
        */
        $script = <<<'EOF'
            #!/bin/sh
            set -e

            parted -s $STORAGE "resizepart 2 -1" "quit"
            resize2fs -f $PART2

            mkdir -p /mnt/boot /mnt/root
            mount -t ext4 $PART2 /mnt/root
            umount /mnt/root
            mount -t vfat $PART1 /mnt/boot
            sed -i 's| init=/usr/lib/raspi-config/init_resize\.sh||' /mnt/boot/cmdline.txt
            umount /mnt/boot
        EOF;

        Script::create([
            'name' => 'Resize ext4 partition',
            'script_type' => 'postinstall',
            'priority' => 50,
            'bg' => false,
            'script' => $script,
        ]);

        /*
        /* This script adds the dtoverlay=dwc2,dr_mode=host line to the config.txt file on the boot partition.
        /* This is necessary for Raspberry Pi devices to enable USB OTG host mode, which allows the device to act as a USB host and connect to other USB devices.
        /* This is typically used for devices that need to connect to USB peripherals, such as keyboards, mice, or USB storage devices.
        */

        $script = <<<'EOF'
            #!/bin/sh
            set -e

            mkdir -p /mnt/boot
            mount -t vfat $PART1 /mnt/boot
            echo "dtoverlay=dwc2,dr_mode=host" >> /mnt/boot/config.txt
            umount /mnt/boot
        EOF;

        Script::create([
            'name' => 'Add dtoverlay=dwc2,dr_mode=host to config.txt',
            'script_type' => 'postinstall',
            'priority' => 75,
            'bg' => false,
            'script' => $script,
        ]);

        /*
        /* This script is for Raspberry Pi 4 devices with eMMC storage.
        /* It formats the eMMC as pSLC, which can significantly improve the lifespan of the storage when used in write-intensive applications.
        /* Note that this is a one-time operation and cannot be undone, so it should only be run on new devices or those where data loss is acceptable.
        */

        $script = <<<'EOF'
            #!/bin/sh
            set +e

            MAXSIZEKB=`mmc extcsd read /dev/mmcblk0 | grep MAX_ENH_SIZE_MULT -A 1 | grep -o '[0-9]\+ '`
            mmc enh_area set -y 0 $MAXSIZEKB /dev/mmcblk0
            if [ $? -eq 0 ]; then
                reboot -f
            fi
        EOF;

        Script::create([
            'name' => 'Format eMMC as pSLC (one time settable only)',
            'script_type' => 'preinstall',
            'priority' => 100,
            'bg' => false,
            'script' => $script,
        ]);
    }
}

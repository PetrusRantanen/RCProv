<?php

namespace App\Console\Commands;

use App\Models\EthernetSwitch;
use App\Models\Setting;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('ethernetswitch:configure')]
#[Description('Connect to managed Ethernet switch by SNMP for port identification purposes')]
class ConfigureEthernetSwitch extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ip = $this->ask('Ethernet switch IP-address (leave empty to disable module)');
        if (! $ip) {
            Setting::destroy('ethernetswitch_ip');
            Setting::destroy('ethernetswitch_snmp_community');
            echo "Disabled Ethernet switch integration\n";

            return 0;
        }

        do {
            $community = $this->ask('SNMP v2c community name');
        } while (! $community);

        echo "Trying to communicate with Ethernet switch...\n";
        $switch = new EthernetSwitch($ip, $community);
        $table = $switch->getMac2portNameTable();

        if ($table && count($table)) {
            echo "=================================\n";
            echo "Mac -> interface name/alias table\n";
            echo "=================================\n";
            foreach ($table as $mac => $portName) {
                echo "$mac $portName\n";
            }
            echo "=================================\n";

            Setting::updateOrCreate(['key' => 'ethernetswitch_ip'], ['value' => $ip]);
            Setting::updateOrCreate(['key' => 'ethernetswitch_snmp_community'], ['value' => $community]);

            echo "\nCommunication successful. Enabled Ethernet switch integration.\n";

        } else {
            echo "Error communicating with switch. Unable to connect or does not support BRIDGE-MIB.\n";
            echo "Settings unchanged.\n";

            return 1;
        }

        return 0;
    }
}

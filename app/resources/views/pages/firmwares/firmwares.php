<?php

use App\Models\Firmware;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Livewire\Component;

new class extends Component
{
    public $firmware;

    public function render()
    {
        $this->firmware = json_decode(json_encode(Firmware::all(), true));

        return $this->view();
    }

    public function update()
    {
        $path = Firmware::basedir();
        if (! file_exists($path)) {
            mkdir($path);
        }

        $tmpfile = tempnam(sys_get_temp_dir(), 'firmware-download');
        try {
            $client = new Client;
            $r = $client->get('https://api.github.com/repos/raspberrypi/rpi-eeprom/zipball', ['sink' => $tmpfile]);
            if ($r->getStatusCode() != 200) {
                throw new Exception('Expected HTTP response code 200, but received '.$r->getStatusCode().' '.$r->getReasonPhrase());
            }

            $zip = new ZipArchive;
            if (! $zip->open($tmpfile)) {
                throw new Exception('Error opening .zip file');
            }

            // We only want rpi-eeprom-something/firmware/* of the .zip
            $prefix = $zip->getNameIndex(0);
            if (! $prefix) {
                throw new Exception('Error listing .zip file');
            }

            $prefix .= 'firmware-2711/';

            for ($i = 1; $i < $zip->numFiles; $i++) {
                $name = Str::of($zip->getNameIndex($i));
                if (! $name->startsWith($prefix) || $name->contains('../')) {
                    continue;
                }

                $nameWithoutPrefix = $name->substr(strlen($prefix));
                if (substr($nameWithoutPrefix, -1) == '/') {
                    @mkdir($path.'/'.$nameWithoutPrefix, 0755, true);
                } else {
                    @file_put_contents($path.'/'.$nameWithoutPrefix, $zip->getFromIndex($i));
                }
            }

            $zip->close();

            session()->flash('message', 'Laiteohjelmistot päivitetty');
        } catch (Exception $e) {
            session()->flash('error', 'Virhe: '.$e->getMessage());
        }
        @unlink($tmpfile);
    }
};

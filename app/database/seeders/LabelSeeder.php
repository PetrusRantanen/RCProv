<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*
        /* This label template is designed for printing Datamatrix codes on a Brady or CAB label printer using FTP.
        /* The template defines a label with dimensions of 6.35 mm in height and 19.05 mm in width, which is suitable for small labels.
        /* The template includes a Datamatrix code that encodes the MAC address of the device, as well as text fields for the MAC address and the CMIO board (jumper setting).
        /* The label is printed using a raw print command that sends the generated label file directly to the printer without any additional formatting.
        */

        $template = <<<'EOF'
            m m
            J
            ; 6.35 mm label height, 19.05 mm width
            S l1;0,0,6.35,6.35,19.05
            ; 18x18 matrix can hold 25 characters, and at 0.3 mm dot width should be 5.4x5.4 mm
            B 0.4,0.6,0,DATAMATRIX+ROWS18+COLS18,0.3;$mac
            ; text MAC address
            T 6,2,0,3,1.5;$mac
            ; text CMIO board (jumper setting)
            T 14,6,0,3,1.5;$provisionboard
            A 1
        EOF;

        Label::create([
            'name' => 'Datamatrix on Brady/CAB printer',
            'printer_type' => 'ftp',
            'ftp_hostname' => 'CHANGEME',
            'ftp_username' => 'print',
            'ftp_password' => 'ftpprint',
            'print_command' => '/usr/bin/lpr -o raw $file 2>&1',
            'file_extension' => 'jscript',
            'template' => $template,
        ]);
    }
}

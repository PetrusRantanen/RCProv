<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $casts = ['uncompressed_size' => 'integer'];

    public function imagepath()
    {
        return public_path('uploads/'.$this->filename_on_server);
    }

    public function filesize()
    {
        return filesize($this->imagepath());
    }

    public function delete()
    {
        // Delete image from filesystem
        unlink($this->imagepath());

        // Delete from database
        parent::delete();
    }
}

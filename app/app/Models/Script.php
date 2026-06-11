<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    protected $fillable = ['name', 'script_type', 'bg', 'priority', 'script'];

    protected $casts = ['bg' => 'boolean', 'priority' => 'integer'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}

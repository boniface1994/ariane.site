<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScInterface extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'explication',
        'sicubesat',
        'sismallsat',
        'position'
    ];
}

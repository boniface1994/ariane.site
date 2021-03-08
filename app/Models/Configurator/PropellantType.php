<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropellantType extends Model
{
    use HasFactory;

    protected $table = "propellant_type";
    protected $fillable = [
        'name',
        'explication',
        'position'
    ];
}

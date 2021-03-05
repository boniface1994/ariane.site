<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrbitType extends Model
{
    use HasFactory;

    protected $table = "orbit_types";
    protected $fillable = [
        'name',
        'explication',
        'orbit_leo',
        'orbit_sso',
        'tarif_leo',
        'tarif_gto',
        'position'
    ];

    public function parameters() {
   		return $this->hasMany(OrbitTypeParameter::class);
   	}
}

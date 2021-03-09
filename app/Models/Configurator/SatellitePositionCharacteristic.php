<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatellitePositionCharacteristic extends Model
{
    use HasFactory;

    protected $table = "satellite_position_characteristic";
    protected $fillable = [
        'name',
        'max_height',
        'max_length',
        'max_width',
        'max_mass'
    ];

    public function positions() {
   		return $this->hasMany(SatellitePosition::class);
   	}
}

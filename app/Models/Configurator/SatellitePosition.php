<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatellitePosition extends Model
{
    use HasFactory;

    protected $table = "satellite_position";
    protected $fillable = [
        'position',
        'satellite_position_characteristic_id'
    ];

    public function characteristic() {
    	return $this->belongsTo(SatellitePositionCharacteristic::class, 'id', 'satellite_position_characteristic_id');
    }
}

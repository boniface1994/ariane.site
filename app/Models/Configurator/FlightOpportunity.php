<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightOpportunity extends Model
{
    use HasFactory;

    protected $table = "flight_opportunities";
    protected $fillable = [
        'month',
        'year',
        'name',
        'orbit_type_id',
        'altitude',
        'inclination',
        'local_hour',
        'local_minute',
        'ltan',
        'ltdn',
        'position'
    ];

}

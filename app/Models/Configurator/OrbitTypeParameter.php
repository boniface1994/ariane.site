<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrbitTypeParameter extends Model
{
    use HasFactory;

    protected $table = "orbit_type_parameter";
    protected $fillable = [
    	'type',
        'start',
        'end',
        'jump',
        'orbit_type_id'
    ];

    public function orbittype() {
    	return $this->belongsTo(OrbitType::class, 'id', 'orbit_type_id');
    }
}

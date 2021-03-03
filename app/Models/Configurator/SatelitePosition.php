<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatelitePosition extends Model
{
    use HasFactory;

    protected $table = "satelite_position";
    protected $fillable = [
        'name','value'
    ];
}

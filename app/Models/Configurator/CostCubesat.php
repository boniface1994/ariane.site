<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCubesat extends Model
{
    use HasFactory;

    protected $table = "cost_cubesats";
    protected $fillable = [
    	'name'
    ];

    public function options(){
        return $this->hasMany(OptionCostCubesat::class);
    }
}

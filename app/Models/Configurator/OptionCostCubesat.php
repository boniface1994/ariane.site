<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionCostCubesat extends Model
{
    use HasFactory;

    protected $table = "option_cost_cubesats";
    protected $fillable = [
    	'option_id','cost_cubesat_id','cost'
    ];

    public function option(){
        return $this->belongsTo(Option::class);
    }

    public function optionCost(){
        return $this->belongsTo(CostCubesat::class);
    }
}

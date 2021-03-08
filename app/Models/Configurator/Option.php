<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = "options";
    protected $fillable = [
        'name','explication','cubsat','smallsat','weight_dependent','cost','dashboard_available','position'
    ];

    public function costOptions(){
        return $this->belongsToMany(OptionCost::class,'option_cost_options');
    }
}

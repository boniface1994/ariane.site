<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionCost extends Model
{
    use HasFactory;

    protected $table = "option_costs";
    protected $fillable = [
        'mass_min','mass_max'
    ];

    public function options(){
        return $this->hasMany(OptionCostOption::class);
    }
}

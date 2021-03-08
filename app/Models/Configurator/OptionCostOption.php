<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionCostOption extends Model
{
    use HasFactory;

    protected $table = "option_cost_options";
    protected $fillable = [
        'cost','option_id','option_cost_id'
    ];

    public function option(){
        return $this->belongsTo(Option::class);
    }

    public function optionCost(){
        return $this->belongsTo(OptionCost::class);
    }
}

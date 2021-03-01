<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    use HasFactory;

    protected $table = "quarters";
    protected $fillable = [
        'name'
    ];

    public function quarterAvailable(){
        return $this->belongsTo(QuarterAvailable::class,'quarter_id','id');
    }
}

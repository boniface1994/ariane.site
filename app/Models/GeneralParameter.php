<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralParameter extends Model
{
    use HasFactory;

    protected $table = 'general_parameters';
    protected $fillable = [
        'name','value'
    ];
}

<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierType extends Model
{
    use HasFactory;

    protected $table = "supplier_type";
    protected $fillable = [
        'name',
        'explication',
        'sicubesat',
        'sismallsat',
        'position'
    ];
}

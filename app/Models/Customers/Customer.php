<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Project\Project;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";
    protected $fillable =[
        'name','email','phone','company','phone_company','street','postal_code','city','country','function','state'
    ];

    public function projects(){
        return $this->hasMany(Project::class);
    }
}

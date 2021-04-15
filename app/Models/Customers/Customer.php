<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Project;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $guard = 'customer';
    protected $table = "customers";
    protected $fillable =[
        'name','email','phone','company','phone_company','street','postal_code','city','country','function','state','enabled','password'
    ];

    public function projects(){
        return $this->hasMany(Project::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Customer;

class ContactRequest extends Model
{
    use HasFactory;

    protected $table = "contact_request";
    protected $fillable = [
        'message'
    ];

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}

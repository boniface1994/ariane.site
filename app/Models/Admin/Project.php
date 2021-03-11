<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Customer;
use App\Models\Admin\Project\Document;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";
    protected $fillable = [
    	'step_1','step_2','step_3','step_4','valid','received','customer_id','contact_ariane'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function documents(){
    	return $this->hasMany(Document::class);
    }
}

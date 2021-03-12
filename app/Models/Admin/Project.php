<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Customer;
use App\Models\Admin\Project\Document;
use App\Models\Configurator\ScInterface;
use App\Models\Configurator\OrbitType;
use App\Models\Configurator\PropellantType;
use App\Models\Configurator\SupplierType;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";
    protected $fillable = [
    	'step_1','step_2','step_3','step_4','valid','received','customer_id','contact_ariane',
    	'altitude_min','altitude_max','inclination_min','inclination_max','local_time','ltan',
    	'ltdn','sc_interface_id','orbit_type_id','propellant_type_id','supplier_type_id'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function documents(){
    	return $this->hasMany(Document::class);
    }

    public function scInterface(){
    	return $this->hasOne(ScInterface::class);
    }

    public function orbitType(){
    	return $this->hasOne(OrbitType::class);
    }

    public function propellantType(){
    	return $this->hasOne(PropellantType::class);
    }

    public function supplierType(){
    	return $this->hasOne(SupplierType::class);
    }
}

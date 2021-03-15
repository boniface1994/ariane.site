<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class QuarterAvailable extends Model
{
    use HasFactory;

    protected $table = "quarter_availables";
    protected $fillable = [
        'month','trimester','year','user_id','quarter_id','quart'
    ];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function quarter(){
        return $this->hasOne(Quarter::class,'id','quarter_id');
    }
}

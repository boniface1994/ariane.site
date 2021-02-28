<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class QuarterAvailable extends Model
{
    use HasFactory;

    protected $table = "quarters_availables";
    protected $fillable = [
        'month','trimester','year','user_id','quarter_id'
    ];
    public function user(){
        return $this->haseOne(User::class,'id','user_id');
    }

    public function quarter(){
        return $this->haseOne(Quarter::class,'id','quarter_id');
    }
}

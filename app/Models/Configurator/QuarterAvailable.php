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
        'month','trimester','year'
    ];
    public function user(){
        return $this->haseOne(User::class,'id','user_id');
    }
}

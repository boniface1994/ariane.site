<?php

namespace App\Models\Configurator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TechnicalMaturity extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "technical_maturity";
    protected $fillable = [
        'title',
        'position',
        'user_id'
    ];
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}

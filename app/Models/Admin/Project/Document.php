<?php

namespace App\Models\Admin\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Project;
class Document extends Model
{
    use HasFactory;

    protected $table = "documents";
    protected $fillable = [
    	'name','project_id','ext','type'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}

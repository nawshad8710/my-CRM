<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }



    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    
    public function user_project()
    {
        return $this->belongsTo(UserProject::class,'user_id','id');
    }


}

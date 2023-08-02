<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserReport extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function user_project()
    {
        return $this->belongsTo(UserProject::class,'user_project_id');
    }
}

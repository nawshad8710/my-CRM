<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    /*
    |--------------------------------------------------------------------------
    | USER RELATION (RELATION)
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    /*
    |--------------------------------------------------------------------------
    | PROJECT RELATION (RELATION)
    |--------------------------------------------------------------------------
    */

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }



    /*
    |--------------------------------------------------------------------------
    | USER PROJECT RELATION (RELATION)
    |--------------------------------------------------------------------------
    */

    public function user_project()
    {
        return $this->belongsTo(UserProject::class, 'user_project_id');
    }


    /*
    |--------------------------------------------------------------------------
    | PROBLEM RELATION (RELATION)
    |--------------------------------------------------------------------------
    */

    public function problem()
    {
        return $this->belongsTo(Problem::class, 'user_problem_id');
    }
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Query extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | USER (RELATION)
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

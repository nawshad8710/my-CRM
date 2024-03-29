<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function keyFeature()
    {
        return $this->hasMany(CategoryKeyFeature::class, 'category_id');
    }

}

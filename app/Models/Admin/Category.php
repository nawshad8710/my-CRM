<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];



    /*
    |--------------------------------------------------------------------------
    | CREATE SLUG (BOOT THE MODEL)
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::created(function ($category) {
            $category->slug = $category->createSlug($category->name);
            $category->save();
        });
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE SLUG (WRITE CODE ON METHOD)
    |--------------------------------------------------------------------------
    */

    private function createSlug($name){
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereTitle($name)->latest('id')->skip(1)->value('slug');

            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }

            return "{$slug}-2";
        }

        return $slug;
    }

}

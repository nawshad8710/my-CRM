<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function saleItem()
    {
        return $this->hasMany(SaleItem::class, 'product_id');
    }


    /*
    |--------------------------------------------------------------------------
    | PRODUCT FEATURE (RELATION)
    |--------------------------------------------------------------------------
    */
    public function feature()
    {
        return $this->hasMany(ProductFeature::class,'product_id');
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCT KEY FEATURE (RELATION)
    |--------------------------------------------------------------------------
    */

    public function keyFeature()
    {
        return $this->hasMany(ProductKeyFeature::class, 'product_id');
    }
}

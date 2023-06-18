<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

protected $fillable = ['product_id'];


public function sale()
{
    return $this->belongsTo(Sale::class, 'sale_id');
}
}

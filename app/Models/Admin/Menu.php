<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function menu_head()
    {
        return $this->belongsTo(MenuHead::class,'menu_head_id');
    }

    public function role() {
        return $this->belongsToMany(Role::class);
    }
}

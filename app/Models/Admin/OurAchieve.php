<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurAchieve extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = ['title', 'short_description'];

    public function achiveItem()
    {
        return $this->hasOne(OurAchieveItem::class, 'our_achieve_id');
    }

}

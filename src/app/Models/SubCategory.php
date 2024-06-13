<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function soldItems()
    {
        return $this->hasMany(SoldItem::class);
    }


}

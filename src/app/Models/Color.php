<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'color'
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

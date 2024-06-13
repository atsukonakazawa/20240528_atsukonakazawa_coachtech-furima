<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'sold_item_id',
        'user_id'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function soldItem()
    {
        return $this->belongsTo(SoldItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

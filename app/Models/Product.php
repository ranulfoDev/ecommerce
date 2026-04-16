<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Product extends Model
{   
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image'
    ];

    // CATEGORY
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ORDER ITEMS
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // REVIEWS
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }

    // 🔥 AUTO IMAGE FIX
    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : 'https://via.placeholder.com/300';
    }

    // 🔥 STOCK CHECK
    public function isInStock()
    {
        return $this->stock > 0;
    }

    // 🔥 PRICE FORMAT
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }
}
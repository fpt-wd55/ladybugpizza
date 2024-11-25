<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topping extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'price',
        'quantity',
        'category_id'
    ];

    public function categories() {
        return $this->belongsTo(Category::class);
    }

    public function carts() {
        return $this->belongsToMany(Cart::class, 'cart_toppings');
    }

    public function orderItems() {
        return $this->belongsToMany(OrderItem::class, 'order_item_toppings');
    }
}

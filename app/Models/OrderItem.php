<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_attribute_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'order_item_toppings');
    }
}

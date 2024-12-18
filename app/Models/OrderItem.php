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
        'product_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function attributes()
    {
        return $this->hasMany(OrderItemAttribute::class);
    }

    public function atrributeValues()
    {
        return $this->hasManyThrough(AttributeValue::class, OrderItemAttribute::class, 'order_item_id', 'id', 'id', 'attribute_value_id');
    }

    public function toppings()
    {
        return $this->hasMany(OrderItemTopping::class);
    }

    public function toppingValues()
    {
        return $this->hasManyThrough(Topping::class, OrderItemTopping::class, 'order_item_id', 'id', 'id', 'topping_id');
    }
}

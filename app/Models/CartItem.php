<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function toppings()
    {
        return $this->hasMany(CartItemTopping::class);
    }

    public function toppingValues()
    {
        return $this->hasManyThrough(Topping::class, CartItemTopping::class, 'cart_item_id', 'id', 'id', 'topping_id');
    }

    public function attributes()
    {
        return $this->belongsTo(CartItemAttribute::class);
    }

    public function attributeValues()
    {
        return $this->hasManyThrough(AttributeValue::class, CartItemAttribute::class, 'cart_item_id', 'id', 'id', 'attribute_value_id');
    }
}

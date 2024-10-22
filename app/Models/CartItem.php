<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'price',
        'discount_price',
        'quantity',
        'amount',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function toppings()
    {
        return $this->hasMany(CartItemTopping::class);
    }

    public function attributes()
    {
        return $this->belongsTo(CartItemAttribute::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItemAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_item_id',
        'attribute_value_id',
    ];

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }

    public function attribute_value()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}

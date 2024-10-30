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

    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'order_item_attributes');
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'order_item_toppings');
    }

    public function productAttributes()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}

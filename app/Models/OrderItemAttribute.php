<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'product_attribute_id',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}

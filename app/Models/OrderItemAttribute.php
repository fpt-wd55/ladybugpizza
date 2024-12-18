<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'attribute_value_id',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function attribute_value()
    {
        return $this->belongsTo(AttributeValue::class)->withTrashed();
    }
}

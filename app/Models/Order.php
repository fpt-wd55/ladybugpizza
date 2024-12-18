<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'promotion_id',
        'amount',
        'address_id',
        'order_status_id',
        'discount_amount',
        'shipping_fee',
        'note',
        'payment_method_id',
        'canceled_at',
        'cancelled_reason',
        'fullname',
        'phone',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class)->withTrashed();
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}

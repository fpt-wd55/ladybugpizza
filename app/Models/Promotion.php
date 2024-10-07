<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'quantity',
        'min_order_total',
        'max_discount',
        'is_global',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'promotion_users');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_attribute_id',
        'quantity',
        'price',
        'total',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function toppings() {
        return $this->belongsToMany(Topping::class, 'cart_toppings');
    }

    public function productAttribute() {
        return $this->belongsTo(ProductAttribute::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_attribute_id',
        'quantity',
        'price',
        'total',
    ];

    public function toppings() {
        return $this->belongsToMany(Topping::class);
    }
}

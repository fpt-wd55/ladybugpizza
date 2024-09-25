<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'category_id',
        'price',
        'discount_price',
        'quantity',
        'sku',
        'status',
        'is_featured',
        'avg_rating',
        'total_rating',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function evalutions()
    {
        return $this->hasMany(Evalution::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}

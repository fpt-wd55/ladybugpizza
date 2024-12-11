<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'value',
        'daily_quantity',
        'quantity',
        'price',
        'price_type',
    ];

    public function attributes()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function price($product)
    {
        $priceProduct = $product->discount_price == 0 ? $product->price : $product->discount_price;
        return round(($this->price_type == 1 ? $this->price : ($this->price * $priceProduct) / 100) / 1000) * 1000;
    }
    
    public function cartItemAttributes()
    {
        return $this->hasMany(CartItemAttribute::class);
    }

}

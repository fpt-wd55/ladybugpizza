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
        return round(($this->price_type == 1 ? $this->price : ($this->price * $product->price) / 100) / 1000) * 1000;
    }
}

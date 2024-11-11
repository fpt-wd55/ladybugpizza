<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboDetail extends Model
{
    use HasFactory;

    protected $fillable = [
          'combo_id',
          'product_attribute_id'
    ];

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}

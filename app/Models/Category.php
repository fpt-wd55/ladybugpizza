<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'status', 
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function toppings()
    {
        return $this->hasMany(Topping::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
    public function comboDetails()
    {
        return $this->hasManyThrough(
            ComboDetail::class,
            Product::class,
            'category_id',
            'combo_id',       
            'id',           
            'id'              
        );
    }
}

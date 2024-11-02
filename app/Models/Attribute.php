<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id',
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

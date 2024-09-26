<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'page_id',
        'image',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}

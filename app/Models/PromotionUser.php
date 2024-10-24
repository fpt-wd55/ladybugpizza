<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PromotionUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'promotion_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

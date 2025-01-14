<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'points',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'quantity',
        'min_order_total',
        'max_discount',
        'is_global',
        'rank_id',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'promotion_users');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function usageCount()
    {
        return $this->orders()->whereNotNull('promotion_id')->count();
    }


    public function rank()
    {
        return $this->belongsTo(MembershipRank::class);
    }
}

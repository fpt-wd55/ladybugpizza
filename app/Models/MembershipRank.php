<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipRank extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'name',
        'min_points',
        'max_points',
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

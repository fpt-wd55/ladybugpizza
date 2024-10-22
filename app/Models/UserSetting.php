<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_order',
        'email_promotions',
        'email_security',
        'push_order',
        'push_promotions',
        'push_security',
    ];
}
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'google_id',
        'role_id',
        'avatar',
        'phone',
        'date_of_birth',
        'gender',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class, 'promotion_users');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public static function getCustomers()
    {
        return self::where('role_id', 2)->get();
    }

    // Phương thức để lấy người dùng có role_id là 3
    public static function getAdmins()
    {
        return self::where('role_id', 3)->get();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isAdmin()
    {
        return $this->role_id == 3;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function avatar()
    {
        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        return $this->avatar ? asset('storage/uploads/avatars/' . $this->avatar) : asset('images/default-avatar.png');
    }
 
    public function setting()
    {   
        return $this->hasOne(UserSetting::class);
    }
}

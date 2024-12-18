<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Membership;
use App\Models\User;
use App\Models\UserSetting;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Exception $e) {
            Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect()->route('auth.login')->with('error', 'Lỗi xác thực từ Google');
        }

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'fullname' => $googleUser->getName(),
                'username' => $this->processString($googleUser->getName()),
                'role_id' => 2,
            ]
        );

        if ($user->wasRecentlyCreated) {
            $this->initializeUser($user);
        }

        if ($user->status == 2) {
            return redirect()->route('auth.login')->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa');
        }

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
    }
    
    protected function initializeUser(User $user)
    {
        Cart::create([
            'user_id' => $user->id,
            'total' => 0,
        ]);

        Membership::create([
            'user_id' => $user->id,
            'points' => 0,
            'rank_id' => 1,
            'total_spent' => 0,
        ]);

        UserSetting::create([
            'user_id' => $user->id,
            'email_order' => true,
            'email_promotions' => true,
            'email_security' => true,
        ]);
    }


    function processString($input)
    {
        $input = Str::ascii($input);
        $input = preg_replace('/[^a-zA-Z0-9]/', '', $input);

        return Str::lower($input) . rand(1, 99);
    }
}

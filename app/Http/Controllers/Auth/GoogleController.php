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

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            try {
                $googleUser = Socialite::driver('google')->user();
            } catch (Exception $e) {
                Log::error('Google OAuth Error: ' . $e->getMessage());
                return redirect()->route('auth.login')->with('error', 'Lỗi xác thực từ Google');
            }

            $user = User::where('email', $googleUser->email)
                ->orWhere('google_id', $googleUser->getId())
                ->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->google_id = $googleUser->getId();
                    $user->avatar = $googleUser->getAvatar();
                    $user->save();
                }
            }

            if (!$user) {
                $user = User::create([
                    'fullname' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'username' => $this->processString($googleUser->getName()),
                    'avatar' => $googleUser->getAvatar(),
                    'google_id' => $googleUser->getId(),
                    'role_id' => 2,
                ]);

                // Thêm giỏ hàng mặc định cho user
                Cart::create([
                    'user_id' => $user->id,
                    'total' => 0,
                ]);

                // Thêm bảng member cho user
                Membership::create([
                    'user_id' => $user->id,
                    'points' => 0,
                    'rank_id' => 1,
                    'total_spent' => 0,
                ]);

                // Thêm bảng setting cho user
                UserSetting::create([
                    'user_id' => $user->id,
                    'email_order' => true,
                    'email_promotions' => true,
                    'email_security' => true,
                ]);

                Auth::login($user);

                return redirect()->route('client.home')->with('success', 'Đăng nhập thành công');
            } else {

                if ($user->status == 2) {
                    return redirect()->route('auth.login')->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa');
                }

                Auth::login($user);

                return redirect()->route('client.home')->with('success', 'Đăng nhập thành công');
            }
        } catch (Exception $e) {
            return redirect()->route('auth.login')->with('error', $e->getMessage());
        }
    }

    function processString($input)
    {

        $transliteration = [
            'à' => 'a',
            'á' => 'a',
            'ạ' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'ầ' => 'a',
            'ấ' => 'a',
            'ậ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'è' => 'e',
            'é' => 'e',
            'ẹ' => 'e',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ê' => 'e',
            'ề' => 'e',
            'ế' => 'e',
            'ệ' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'ị' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ò' => 'o',
            'ó' => 'o',
            'ọ' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ô' => 'o',
            'ồ' => 'o',
            'ố' => 'o',
            'ộ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'ụ' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ư' => 'u',
            'ừ' => 'u',
            'ứ' => 'u',
            'ự' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ỳ' => 'y',
            'ý' => 'y',
            'ỵ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'Đ' => 'D',
            'đ' => 'd',
        ];

        $input = strtr($input, $transliteration);

        $input = preg_replace('/[^a-zA-Z0-9]/', '', $input);

        $randomNumber = rand(1, 99);
        $processed = strtolower($input) . $randomNumber;

        return $processed;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class CheckPasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (!$user->google_id) {
                $plainPassword = session('user_password');

                if (!Hash::check($plainPassword, $user->password)) {
                    $user->remember_token = null;
                    $user->save();
                    session()->invalidate();
                    session()->regenerateToken();
                    Auth::logout();

                    return redirect()->route('client.home')->with('error', 'Mật khẩu đã được thay đổi. Vui lòng đăng nhập lại');
                }
            }

            if ($user->status == 2) {
                session()->invalidate();
                session()->regenerateToken();
                $user->remember_token = null;
                Auth::logout();

                return redirect()->route('client.home')->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa. Vui lòng đăng nhập bằng một tài khoản khác');
            }
        }

        return $next($request);
    }
}

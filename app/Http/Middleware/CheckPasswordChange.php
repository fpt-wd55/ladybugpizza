<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        if (auth()->check()) {
            $user = auth()->user();

            if (!$user->google_id) {
                $plainPassword = session('user_password');

                if (!Hash::check($plainPassword, $user->password)) {
                    $user->remember_token = null;
                    $user->save();

                    session()->invalidate();
                    session()->regenerateToken();
                    auth()->logout();

                    return redirect()->route('client.home')->with('error', 'Mật khẩu đã được thay đổi. Vui lòng đăng nhập lại.');
                }
            }
        }

        return $next($request);
    }
}

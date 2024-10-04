<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
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

            if($user->status == 2) {
                return back()->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa!');
            }

            if ($user->role_id != 2 || $user->role->parent_id == 1) {

                return $next($request);
            }
            return redirect()->route('client.home')->with('success', 'Đăng nhập thành công!');
        }

        return redirect()->route('client.home')->with('error', 'Bạn chưa đăng nhập hoặc không có quyền truy cập!');
    }
}

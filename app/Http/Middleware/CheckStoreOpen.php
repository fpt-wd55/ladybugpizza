<?php

namespace App\Http\Middleware;

use App\Models\OpeningHour;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStoreOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra giờ mở cửa
        if (!OpeningHour::isOpen()) {
            return redirect()->back()->with('error', 'Vui lòng quay lại sau giờ mở cửa');
        }

        // Tiếp tục xử lý request nếu giờ mở cửa hợp lệ
        return $next($request);
    }
}

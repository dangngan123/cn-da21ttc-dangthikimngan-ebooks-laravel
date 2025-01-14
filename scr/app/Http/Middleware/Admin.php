<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {



        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            // Kiểm tra nếu là admin
            if (Auth::user()->utype === 'admin') {
                // Chặn truy cập cart, checkout và các action thêm/xóa giỏ hàng
                if (
                    $request->routeIs('cart') ||
                    $request->routeIs('checkout') || // chặn thêm vào giỏ
                    $request->is('*/cart/*') ||         // chặn các action liên quan giỏ hàng
                    strpos($request->path(), 'cart') !== false  // chặn bất kỳ URL nào có chứa 'cart'
                ) {
                    return back()->with('error', 'Admin không được phép truy cập các chức năng mua sắm');
                }
            }
        }

        return $next($request);
    }
}

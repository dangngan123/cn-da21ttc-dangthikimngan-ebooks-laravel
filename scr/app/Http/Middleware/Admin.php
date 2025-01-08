<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng có phải là admin không
        if (Auth::check() && Auth::user()->utype !== 'admin') {
            // Nếu không phải là admin, chuyển hướng về trang login
            return redirect()->route('login');
        }

        // Tiếp tục xử lý yêu cầu nếu người dùng là admin
        return $next($request);
    }
}

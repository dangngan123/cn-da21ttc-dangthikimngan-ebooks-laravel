<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Kiểm tra email đã tồn tại
            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                if ($existingUser->google_id) {
                    // Đã có tài khoản Google, đăng nhập bình thường
                    Auth::login($existingUser);
                    return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
                } else {
                    // Liên kết tài khoản hiện tại với Google
                    $existingUser->update([
                        'google_id' => $googleUser->getId()
                    ]);
                    Auth::login($existingUser);
                    return redirect()->route('home')
                        ->with('success', 'Tài khoản của bạn đã được liên kết với Google!');
                }
            }

            // Tạo tài khoản mới nếu chưa tồn tại
            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)),
                'utype' => 'customer',
            ]);

            Auth::login($newUser);
            return redirect()->route('home')->with('success', 'Đăng ký và đăng nhập thành công!');
        } catch (\Exception $e) {
            Log::error('Google Login Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('login')
                ->with('error', 'Đăng nhập thất bại. Lỗi: ' . $e->getMessage());
        }
    }
}

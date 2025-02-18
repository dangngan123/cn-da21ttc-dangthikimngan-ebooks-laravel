{{--<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
@csrf

<!-- Password Reset Token -->
<input type="hidden" name="token" value="{{ $request->route('token') }}">

<!-- Email Address -->
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />
    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-4">
    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

    <x-text-input id="password_confirmation" class="block mt-1 w-full"
        type="password"
        name="password_confirmation" required autocomplete="new-password" />

    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<div class="flex items-center justify-end mt-4">
    <x-primary-button>
        {{ __('Reset Password') }}
    </x-primary-button>
</div>
</form>
</x-guest-layout>--}}
<x-app-layout>

    <main class="main">
        <style>
            .input-box {
                width: 100%;
                display: flex;
                align-items: center;
                position: relative;
            }

            .input-box img {
                width: 18px;
                cursor: pointer;
                position: absolute;
                right: 10px;
            }
        </style>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Login
                </div>
            </div>
        </div>
        <section class="pt-20 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{asset('assets/imgs/login.png')}}" alt="">
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-5">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30" style="text-align: center">Khôi Phục Mật Khẩu</h3>
                                        </div>
                                        <x-auth-session-status class="mb-4" :status="session('status')" />
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <form method="POST" action="{{ route('password.store') }}">
                                            @csrf

                                            <!-- Password Reset Token -->
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                            <div class="form-group">
                                                <input type="email" required="" placeholder="abc@gmail.com" name="email" :value="old('email')">
                                            </div>

                                            <div class="form-group">
                                                <input type="password" required="" placeholder="Phải đủ 8 ký tự" name="password" autocomplete="new-password">
                                            </div>

                                            <div class="form-group">
                                                <input type="password" required="" placeholder="Nhập lại mật khẩu" name="password_confirmation" :value="old('email')">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up w-100 btn-sm" name="login">Đặt lại mật khẩu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
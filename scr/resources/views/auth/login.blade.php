{{--<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
@csrf

<!-- Email Address -->
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password" class="block mt-1 w-full"
        type="password"
        name="password"
        required autocomplete="current-password" />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Remember Me -->
<div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
    </label>
</div>

<div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
    </a>
    @endif

    <x-primary-button class="ms-3">
        {{ __('Log in') }}
    </x-primary-button>
</div>
</form>
</x-guest-layout> --}}

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

            .btn-google {
                background-color: #db4437;
                color: white;
                font-size: 14px;
                padding: 10px;
                border-radius: 5px;
                text-align: center;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 20px;
            }

            .btn-google img {
                margin-right: 10px;
                width: 20px;
                height: 20px;
            }

            .login-wrap {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .page-header {
                background: #f8f9fa;
                padding: 20px 0;
            }

            .breadcrumb {
                font-size: 16px;
                color: #6c757d;
            }

            .breadcrumb a {
                color: #007bff;
            }

            .login-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
            }

            .login-footer .checkbox {
                font-size: 12px;
            }

            .login-footer a {
                color: #007bff;
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
                                <img src="assets/imgs/login.png" alt="Login Image" class="img-fluid">
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-5">
                                <div class="login-wrap">
                                    <div class="heading_s1 text-center">
                                        <h3 class="mb-30">Đăng Nhập</h3>
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
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" required="" placeholder="abc@gmail.com" name="email" :value="old('email')" class="form-control">
                                        </div>
                                        <div class="form-group input-box">
                                            <input required="" placeholder="Phải đủ 8 ký tự" type="password" name="password" id="password" class="form-control">
                                            <img class="ms-2" src="{{ asset('assets/imgs/login/close.png') }}" alt="" id="eyeicon">
                                        </div>

                                        <div class="login-footer">
                                            <div class="checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                <label class="form-check-label" for="exampleCheckbox1"><span>Nhớ mật khẩu</span></label>
                                            </div>
                                            <a href="{{ route('password.request') }}" class="text-muted">Quên mật khẩu?</a>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-danger w-100 btn-sm">Đăng Nhập</button>
                                        </div>
                                    </form>

                                    <!-- Nút đăng nhập bằng Google -->
                                    <div class="form-group text-center">
                                        <a href="{{ route('google.callback') }}" class="btn-google">
                                            <img src="{{ asset('assets/imgs/login/google.png') }}" alt="Google Icon">
                                            Đăng nhập bằng Google
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        let password = document.getElementById('password');
        let eyeicon = document.getElementById('eyeicon');
        eyeicon.onclick = function() {
            if (password.type == "password") {
                password.type = "text";
                eyeicon.src = "{{asset('assets/imgs/login/show.png')}}";
            } else {
                password.type = "password";
                eyeicon.src = "{{asset('assets/imgs/login/close.png')}}";
            }
        }
    </script>
</x-app-layout>
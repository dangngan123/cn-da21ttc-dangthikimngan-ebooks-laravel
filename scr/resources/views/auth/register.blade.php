{{--<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
@csrf

<!-- Name -->
<div>
    <x-input-label for="name" :value="__('Name')" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Email Address -->
<div class="mt-4">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password" class="block mt-1 w-full"
        type="password"
        name="password"
        required autocomplete="new-password" />

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
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>

    <x-primary-button class="ms-4">
        {{ __('Register') }}
    </x-primary-button>
</div>
</form>
</x-guest-layout>--}}
<x-app-layout>
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
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Register
                </div>
            </div>
        </div>
        <section class="pt-30 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30" style="text-align: center">Đăng Ký</h3>
                                        </div>
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="name" placeholder="Nguyen Van A" :value="old('name')">
                                                <x-input-error :messages="$errors->get('name')" class="text-danger" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="nguyenvana@gmail.com" :value="old('email')">
                                                <x-input-error :messages="$errors->get('email')" class="text-danger" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Phải đủ 8 ký tự">
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                                <x-input-error :messages="$errors->get('password')" class="text-danger" />
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>Tôi đồng ý với các điều khoản.</span></label>
                                                    </div>
                                                </div>
                                                <a href="privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up w-100 btn-sm" name="login">Đăng Kí</button>
                                            </div>
                                        </form>
                                        <!-- Nút đăng nhập bằng Google -->
                                        <div class="form-group text-center">
                                            <a href="{{ route('google.callback') }}" class="btn-google">
                                                <img src="{{ asset('assets/imgs/login/google.png') }}" alt="Google Icon">
                                                Đăng nhập bằng Google
                                            </a>
                                        </div>
                                        <div class="text-muted text-center">Đã có tài khoản?<a href="#"> Đăng nhập ngay</a></div>




                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img src="assets/imgs/login.png">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
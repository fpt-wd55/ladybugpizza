@extends('layouts.shared')

@section('title', 'Đăng ký')

@section('content')
    <div class="w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4 transition">
        <div class="md:grid md:grid-cols-2 gap-4 card">
            <div class="p-4 md:p-6 lg:p-8">
                <div class="mb-4">
                    <div class="mb-4 font-semibold text-lg uppercase">
                        Đăng ký
                    </div>
                    <div class="flex gap-2 text-sm">
                        <label for="">Bạn đã có có tài khoản?</label>
                        <a href="{{ route('auth.login') }}" class="text-red-600">Đăng
                            nhập</a>
                    </div>
                </div>
                <form action="{{ route('auth.post-register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="font-medium" for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            placeholder="VD: 0123456789" class="mt-2 mb-2 input">
                        @error('phone')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="font-medium" for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}"
                            placeholder="VD: lazzybugpizza@gmail.com" class="mt-2 mb-2 input">
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="font-medium" for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="mt-2 mb-2 input">
                        @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="font-medium" for="password_confirmation">Nhập lại mật khẩu</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-2 mb-2 input">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-8">
                        <div class="">
                            <input type="checkbox" name="agree" id="agree" class="input-checkbox mb-1">
                            <label for="agree" class="text-sm ms-1">Khách hàng đồng ý với</label>
                            <a href="{{ route('client.policies') }}" class="text-red-600 text-sm">chính sách và điều
                                khoản</a>
                        </div>
                        @error('agree')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <button disabled id="registerButton"
                        class="mb-4 bg-red-600 flex items-center justify-center button-red w-full disabled:bg-gray-300 disabled:text-gray-600 transition">
                        Đăng ký
                    </button>
                    <p class="mb-4 text-center text-sm">
                        Hoặc
                    </p>
                    <a href="{{ route('auth.google.redirect') }}"
                        class="mb-4 bg-red-600 flex items-center justify-center gap-4 button-red">
                        @svg('tabler-brand-google-filled', 'icon-md')
                        Đăng ký bằng Google
                    </a>
                </form>
            </div>
            <div class="hidden md:block max-h-full">
                <img loading="lazy" class="w-full h-full object-cover" src=" {{ asset('storage/uploads/banners/auth_banner1.webp') }}"
                    alt="">
            </div>
        </div>
    </div>

    <script>
        const agree = document.getElementById('agree');
        const registerButton = document.getElementById('registerButton');
        agree.onchange = () => {
            if (agree.checked) {
                registerButton.disabled = false;
            } else {
                registerButton.disabled = true;
            }
        };
    </script>

@endsection

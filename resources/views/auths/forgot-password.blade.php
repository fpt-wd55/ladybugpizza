@extends('layouts.shared')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4 transition">
    <div class="md:grid md:grid-cols-2 gap-4 card">
        <div class=" p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg uppercase">
                    Quên mật khẩu
                </div>
                <div class="label-md">
                    <label for="">Nhập địa chỉ email, bạn sẽ nhận được mật khẩu một lần hoặc liên kết xác minh để xác minh tài khoản của mình</label>

                </div>
                @session('success')
                    <div class="alert-success mt-2">
                        {{ session('success') }}
                    </div>
                @endsession
                @session('error')
                    <div class="alert-error mt-2">
                        {{ session('error') }}
                    </div>
                @endsession
                <form action="{{ route('auth.post-forgot-password') }}" method="POST">
                    @csrf
                    <div class="mb-4 py-4">
                        <label class="font-medium" for="email">E-mail</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}"
                            placeholder="VD: lazzybugpizza@gmail.com" class="mt-2 mb-2 input">
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="mb-4 bg-red-600 flex items-center justify-center gap-4 button-red w-full">
                        Khôi phục mật khẩu
                    </button>
                    <div class="flex items-center justify-center gap-1">
                        <label for="">Bạn có chưa có tài khoản?</label>
                        <a href="{{ route('auth.login') }}" class="text-red-600 font-medium">Đăng
                            nhập</a>
                    </div>
                </form>
            </div>
            <div class="hidden md:block max-h-[629px]">
                <img class="w-full h-full object-cover" src=" {{ asset('storage/uploads/banners/auth_banner1.webp') }}"
                    alt="">
            </div>
        </div>

    </div>

@endsection

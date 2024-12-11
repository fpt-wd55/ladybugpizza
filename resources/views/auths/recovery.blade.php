@extends('layouts.shared')

@section('title', 'Khôi phục mật khẩu')

@section('content')
    <div class="w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4 transition">
        <div class="md:grid md:grid-cols-2 gap-4 card">
            <div class="p-4 md:p-6 lg:p-8">
                <div class="mb-4">
                    <div class="mb-4 font-semibold text-lg uppercase">
                        Khôi phục mật khẩu
                    </div>
                    <p class="text-sm">Tạo mật khẩu mới của bạn</p>
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
                <form action="{{ route('auth.post-recovery') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="font-medium" for="password">Mật khẩu mới <span class="text-red-500">*</span></label>
                        <input type="password" name="password" id="password" class="mt-2 input">
                        @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="font-medium" for="password_confirmation">Nhập lại mật khẩu mới <span
                                class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 input">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="mb-4 bg-red-600 flex items-center justify-center gap-4 button-red w-full">
                        Khôi phục mật khẩu
                    </button>
                </form>
                <div class="text-sm mb-3 text-center">
                    <a href="{{ route('auth.get-otp') }}" class="text-red-600">Xác thực OTP</a>
                </div>
            </div>
            <div class="hidden md:block max-h-[629px]">
                <img loading="lazy" class="w-full h-full object-cover"
                    src=" {{ asset('storage/uploads/banners/auth_banner1.webp') }}" alt="">
            </div>
        </div>
    </div>
@endsection

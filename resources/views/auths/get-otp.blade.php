@extends('layouts.shared')

@section('title', 'Xác thực OTP')

@section('content')
<div class="w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4 transition">
    <div class="md:grid md:grid-cols-2 gap-4 card">
        <div class=" p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg uppercase">
                    Xác thực OTP
                </div>
                <div class="label-sm">
                    <label for="">Vui lòng nhập mã OTP được gửi về email đăng ký của bạn</label>
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
                <form action="{{ route('auth.post-get-otp') }}" method="POST">
                    @csrf
                    <div class="mb-4 pt-4">
                        <label class="font-medium" for="otp">OTP</label>
                        <input type="text" name="otp" id="otp" value="{{ old('otp') }}"
                            class="mt-2 mb-2 input" autofocus>
                        @error('otp')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="mb-4 bg-red-600 flex items-center justify-center gap-4 button-red w-full">
                        Xác nhận OTP
                    </button>

                </form>
            </div>
            <div class="hidden md:block max-h-[629px]">
                <img class="w-full h-full object-cover" src=" {{ asset('storage/uploads/banners/auth_banner1.webp') }}"
                    alt="">
            </div>
        </div>

    </div>

@endsection

@extends('layouts.shared')

@section('title', 'Đăng nhập')

@section('content')
<div class="w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4 transition">
    <div class="md:grid md:grid-cols-2 gap-4 card">
        <div class="p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg uppercase">
                    Đăng nhập
                </div>
                <div class="flex ">
                    <label for="">Bạn chưa có tài khoản?</label>
                    <a href="#" class="text-red-600">Đăng ký</a>
                </div>
            </div>
            @session('error')
            <div class="alert-error">
                {{ session('error') }}
            </div>
            @endsession
            <form action="">
                <div class="mb-4">
                    <label class="font-medium" for="">Email</label>
                    <input type="text" class="mt-2 mb-2 input">
                    <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                </div>
                <div class="mb-4">
                    <label class="font-medium" for="">Mật khẩu</label>
                    <input type="text" class="mt-2 mb-2 input">
                    <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                </div>
                <div class="mb-11 flex justify-between">
                    <div class="flex items-center gap-1">
                        <input type="checkbox" class="input-checkbox">
                        <label for="">Ghi nhớ mật khẩu</label>
                    </div>
                    <div>
                        <a href="#" class="text-red-600 hover:link">Quên mật khẩu?</a>
                    </div>
                </div>
                <button class="mb-4 bg-red-600 w-full flex items-center justify-center button-red">
                    Đăng nhập
                </button>
                <p class="mb-4 text-center text-sm">
                    Hoặc
                </p>
                <a href="{{ route('auth.google.redirect') }}" class="mb-4 bg-red-600 flex items-center justify-center gap-4 button-red">
                    @svg('tabler-brand-google-filled')
                    Đăng nhập bằng Google
                </a>
            </form>
        </div>
        <div class="hidden md:block max-h-[629px]">
            <img class="w-full h-full object-cover" src=" {{ asset('storage/uploads/banners/auth_banner1.webp') }}" alt="">
        </div>
    </div>
</div>

@endsection
@extends('layouts.shared')

@section('title', 'Đăng ký')

@section('content')

<div class="container w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4">
    <div class="md:grid md:grid-cols-2 gap-4 card">
        <div class="p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg uppercase">
                    Đăng ký
                </div>
                <div class="flex gap-2">
                    <label for="">Bạn đã có có tài khoản?</label>
                    <a href="{{route('auth.login')}}" class="text-red-600">Đăng
                        nhập</a>
                </div>
            </div>
            <form action="{{route('auth.post-register')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="font-medium" for="phone">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="mt-2 mb-2 input">
                    @error('phone')
                        <p class="text-red-500 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="font-medium" for="email">Email</label>
                    <input type="text" name="email" id="email" class="mt-2 mb-2 input">
                    @error('email')
                        <p class="text-red-500 text-sm">{{$message}}</p>
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
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 mb-2 input">
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <div class="">
                        <input type="checkbox" name="agree" class="input-checkbox">
                        <label for="agree" class="text-sm">Khách hàng đồng ý với</label>
                        <a href="#" class="text-red-600 text-sm">chính sách và điều khoản</a>
                    </div>
                    @error('agree')
                        <p class="text-red-500 text-sm mt-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-4 bg-red-600 flex items-center justify-center button-red">
                    <button type="submit" class="h-[32px] text-white">Đăng ký</button>
                </div>
                <p class="mb-4 text-center text-sm">
                    Hoặc
                </p>
                <div class="mb-4 bg-red-600 flex items-center justify-center gap-4 button-red">
                    @svg('tabler-brand-google-filled')
                    <button class="h-[32px] text-white">Đăng kí bằng Google</button>
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

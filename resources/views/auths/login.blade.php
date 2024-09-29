@extends('layouts.shared')

@section('title', 'Đăng nhập')

@section('content')

<div class="container w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4">
    <div class="md:grid md:grid-cols-2 gap-4 card">
        <div class="p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg uppercase">
                    Đăng nhập
                </div>
                <div class="flex gap-2">
                    <label for="">Bạn có chưa có tài khoản?</label>
                    <a href="{{route('auth.register')}}" class="text-red-600">Đăng
                        ký</a>
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
            </div>
            <form action="{{route('auth.post-login')}}" method="POST">
                @csrf
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
                        <p class="text-red-500 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-11 flex justify-between">
                    <div class="flex items-center gap-1">
                        <input type="checkbox" name="remember" id="remember" class="input-checkbox">
                        <label for="remember" class="text-sm ms-1">Ghi nhớ mật khẩu</label>
                    </div>
                    <div>
                        <a href="{{route('auth.forgot-password')}}" class="text-red-600 hover:link text-sm">Quên mật khẩu?</a>
                    </div>
                </div>
                @if ($errors->has('error'))
                    <p class="mb-4 py-4 bg-red-100 text-red-500 text-sm">{{$errors->first('error')}}</p>
                @endif
                <button type="submit" class="mb-4 bg-red-600 flex items-center justify-center button-red w-full">
                    Đăng nhập
                </button>
                <p class="mb-4 text-center text-sm">
                    Hoặc
                </p>
                <a href="{{route('auth.google.redirect')}}" class="mb-4 bg-red-600 flex items-center justify-center gap-4 button-red">
                    @svg('tabler-brand-google-filled')
                    Đăng nhập bằng Google
                </a>
            </form>
        </div>
        <div class="hidden md:block max-h-[629px]">
            <img class="w-full h-full object-cover" src=" {{ asset('storage/uploads/banners/auth_banner1.webp') }}"
                alt="">
        </div>

    </div>

</div>

@endsection

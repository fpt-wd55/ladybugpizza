@extends('layouts.shared')

@section('title', 'Quên mật khẩu')

@section('content')

<div class="container w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4">
    <div class="md:grid md:grid-cols-2 gap-4 card">
        <div class=" p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg uppercase">
                    Quên mật khẩu
                </div>
                <div class="label-md">
                    <label for="">Nhập địa chỉ email, bạn sẽ nhận được mật khẩu một lần hoặc liên kết xác minh để xác minh tài khoản của mình</label>
                </div>
            </div>
            <form action="">
                <div class="mb-4 py-4">
                    <label class="font-medium" for="">E-mail</label>
                    <input type="text" class="mt-2 mb-2 input">
                    <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                </div>
                <div class="mb-4 bg-red-600 flex items-center justify-center gap-4 button-red">
                    <button class="h-[32px] text-white">Khôi phục mật khẩu</button>
                </div>
                <div class="flex items-center justify-center gap-1">
                    <label for="">Bạn có chưa có tài khoản?</label>
                    <a href="{{route('auth.login')}}" class="text-red-600 font-medium">Đăng
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

@extends('layouts.shared')

@section('title', 'Đăng ký')

@section('content')

<div class="container w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4 transition">
    <div class="md:grid md:grid-cols-2 gap-4 card">
        <div class=" p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg uppercase">
                    Đăng ký
                </div>
                <div>
                    <label for="">Bạn đã có có tài khoản?</label>
                    <a href="#" class="text-red-600">Đăng
                        nhập</a>
                </div>
            </div>
            <form action="">
                <div class="mb-4">
                    <label class="font-medium" for="">Số điện thoại</label>
                    <input type="text" class="mt-2 mb-2 input">
                    <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                </div>
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
                <div class="mb-4">
                    <label class="font-medium" for="">Nhập lại mật khẩu</label>
                    <input type="text" class="mt-2 mb-2 input">
                    <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                </div>
                <div class="mb-11">
                    <div class="">
                        <input type="checkbox" class="input-checkbox">
                        <label for="" class="text-xs">Khách hàng đồng ý với</label>
                        <a href="#" class="text-red-600 text-xs">chính sách và điều khoản</a>
                    </div>
                    <div>
                    </div>
                </div>
                <div class="mb-4 bg-red-600 flex items-center justify-center button-red">
                    <button class="h-[32px] text-white">Đăng nhập</button>
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
        <div class="hidden md:block max-h-full">
            <img class="w-full h-full object-cover" src=" {{ asset('storage/uploads/banners/auth_banner1.webp') }}"
                alt="">
        </div>
    </div>

</div>

@endsection
@extends('layouts.shared')

@section('title', 'Khôi phục mật khẩu')

@section('content')

<div class="container w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4">
    <div class="md:grid md:grid-cols-2 gap-4 card">
        <div class=" p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg uppercase">
                    Khôi phục mật khẩu
                </div>
                <div class="label-sm">
                    <label for="">Nhập mật khẩu mới của bạn</label>
                </div>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="mb-4 py-4">
                    <label class="font-medium" for="">Mật khẩu mới </label>
                    <input type="text" class="mt-2 mb-2 input">
                    <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                </div>
                <div class="mb-4 py-4">
                    <label class="font-medium" for="">Nhập lại mật khẩu mới </label>
                    <input type="text" class="mt-2 mb-2 input">
                    <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                </div>
                <div class="mb-4 bg-red-600 flex items-center justify-center gap-4 button-red">
                    <button class="h-[32px] text-white">Khôi phục mật khẩu</button>
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

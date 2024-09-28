@extends('layouts.shared')

@section('title', 'Thu thập thông tin người dùng')

@section('content')

<div class="container w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4">
    <div class="md:grid gap-4 card">
        <div class=" p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg">
                    Cập nhật thông tin 
                </div>
            </div>
            <form action="">
                <div class=" md:flex items-center justify-between  w-full md:grid-cols-2 gap-4">
                    <div class="mb-4 py-4  w-full">
                        <label class="font-medium" for="">Họ và tên </label>
                        <input type="text" class="mt-2 mb-2 input">
                        <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                    </div>
                    <div class="mb-4 py-4  w-full">
                        <label class="font-medium" for="">Ngày sinh </label>
                        <input type="text" class="mt-2 mb-2 input">
                        <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                    </div>
                </div>
                <div class="md:flex items-center justify-between w-full md:grid-cols-2 gap-4">
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="">Giới tính </label>
                        <input type="text" class="mt-2 mb-2 input">
                        <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                    </div>
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="">Ảnh đại diện </label>
                        <input type="text" class="mt-2 mb-2 input">
                        <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                    </div>
                </div>
                <div class="mb-4 py-4">
                    <label class="font-medium" for="">Địa chỉ </label>
                    <input type="text" class="mt-2 mb-2 input">
                    <p class="text-red-500 text-sm">Hiển thị lỗi</p>
                </div>
                <div class="flex items-center justify-end mt-14 gap-6">
                    <div class=" flex items-center justify-center  hover:cursor-pointer button-light w-28">                
                        <p class="h-[32px] text-gray-950 pt-1 ">Bỏ qua</p>
                    </div>
                    <div class=" bg-red-600 flex items-center justify-center button-red w-28">                
                        <button class="h-[32px] text-white">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
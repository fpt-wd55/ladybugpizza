@extends('layouts.client')

@section('title', 'Cài đặt')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">

            @include('clients.profile.sidebar')
            <div class="card p-4 md:p-8 w-full min-h-screen">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="font-semibold uppercase">Cài đặt</h3>
                </div>

                {{-- Email notice --}}
                <div class="mb-8">
                    <p class="font-medium mb-4">Thông báo Email</p>
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm">Thông báo cập nhật tình trang đơn hàng</p>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <span class="button-toggle"></span>
                        </label>
                    </div>
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm">Thông báo khuyến mãi và các sự kiện mới</p>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <span class="button-toggle"></span>
                        </label>
                    </div>
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm">Thông báo về bảo mật và tài khoản</p>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <span class="button-toggle"></span>
                        </label>
                    </div>
                </div>

                {{-- Push notice --}}
                <div class="mb-8">
                    <p class="font-medium mb-4">Thông báo đẩy</p>
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm">Thông báo cập nhật tình trang đơn hàng</p>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <span class="button-toggle"></span>
                        </label>
                    </div>
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm">Thông báo khuyến mãi và các sự kiện mới</p>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <span class="button-toggle"></span>
                        </label>
                    </div>
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm">Thông báo về bảo mật và tài khoản</p>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <span class="button-toggle"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

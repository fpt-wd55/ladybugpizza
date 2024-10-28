@extends('layouts.client')

@section('title', 'Thanh toán')

@section('content')
    <div class="min-h-screen">
        <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
            <div class="card p-4 md:p-8 mb-12">
                <p class="title">THANH TOÁN</p>
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

                    {{-- Thông tin nhận hàng --}}
                    <div class="col-span-3">
                        <div class="mb-8">
                            <p class="font-medium mb-4">Thông tin nhận hàng</p>
                            <div class="mb-4">
                                <p for="" class="mb-2 text-sm font-normal">Họ và tên: <span
                                        class="text-red-600">*</span>
                                </p>
                                <input type="text" class="input w-full">
                                <span class="text-sm text-red-600">Thông báo lỗi</span>
                            </div>
                            <div class="mb-4">
                                <p for="" class="mb-2 text-sm font-normal">Số điện thoại: <span
                                        class="text-red-600">*</span></p>
                                <input type="text" class="input w-full">
                                <span class="text-sm text-red-600">Thông báo lỗi</span>
                            </div>
                            <div class="mb-4">
                                <p for="" class="mb-2 text-sm font-normal">Email: <span
                                        class="text-red-600">*</span>
                                </p>
                                <input type="text" class="input w-full">
                                <span class="text-sm text-red-600">Thông báo lỗi</span>
                            </div>
                            <div class="mb-4">
                                <p for="" class="mb-2 text-sm font-normal">Sử dụng địa chỉ mặc định: <span
                                        class="text-red-600">*</span>
                                </p>
                                <input type="text" class="input w-full">
                                <span class="text-sm text-red-600">Thông báo lỗi</span>
                            </div>
                            <div class="mb-4 grid grid-cols-12 items-center gap-4">
                                <div class="col-span-12 lg:col-span-4">
                                    <p for="" class="mb-2 text-sm font-normal">Tỉnh/Thành phố: <span
                                            class="text-red-600">*</span></p>
                                    <input type="text" class="input w-full">
                                    <span class="text-sm text-red-600">Thông báo lỗi</span>
                                </div>
                                <div class="col-span-6 lg:col-span-4">
                                    <p for="" class="mb-2 text-sm font-normal">Quận/Huyện: <span
                                            class="text-red-600">*</span></p>
                                    <input type="text" class="input w-full">
                                    <span class="text-sm text-red-600">Thông báo lỗi</span>
                                </div>
                                <div class="col-span-6 lg:col-span-4">
                                    <p for="" class="mb-2 text-sm font-normal">Phường/Xã: <span
                                            class="text-red-600">*</span></p>
                                    <input type="text" class="input w-full">
                                    <span class="text-sm text-red-600">Thông báo lỗi</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p for="" class="mb-2 text-sm font-normal">Địa chỉ chi tiết: <span
                                        class="text-red-600">*</span>
                                </p>
                                <textarea type="text" class="text-area w-full"></textarea>
                                <span class="text-sm text-red-600">Thông báo lỗi</span>
                            </div>
                        </div>
                    </div>

                    {{-- Thanh toán --}}

                    <div class="col-span-2">
                        <div class="mb-16">
                            <p class="font-medium mb-4">Đơn hàng của bạn</p>
                            <div class="">
                                <div class="flex items-center justify-between mb-4 gap-32 text-sm">
                                    <p class="">Tổng tiền sản phẩm</p>
                                    <p class="font-medium">150,000₫</p>
                                </div>
                                <div class="flex items-center justify-between mb-4 gap-32 text-sm">
                                    <p class="">Phí vận chuyển</p>
                                    <p class="font-medium">150,000₫</p>
                                </div>
                                <div class="flex items-center justify-between mb-4 gap-32 text-sm">
                                    <p class="">Giảm giá</p>
                                    <p class="font-medium">150,000₫</p>
                                </div>
                                <hr class="mb-4">
                                <div class="flex items-center justify-end mb-4 gap-32">
                                    <p class="font-medium">150,000₫</p>
                                </div>
                            </div>
                            <div class="mb-16">
                                <p class="font-medium mb-4">Phương thức thanh toán</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center mb-4">
                                        <input id="default-radio-1" type="radio" value="" name="default-radio"
                                            class="input-radio me-2">
                                        <label for="default-radio-1" class="text-sm font-normal">Thanh toán khi nhận
                                            hàng</label>
                                    </div>
                                    @svg('tabler-truck', 'icon-lg text-gray-700')
                                </div>
                                <hr class="mb-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center mb-4">
                                        <input id="default-radio-1" type="radio" value="" name="default-radio"
                                            class="input-radio me-2">
                                        <label for="default-radio-1" class="text-sm font-normal">Ví MoMo</label>
                                    </div>
                                    @svg('tabler-credit-card', 'icon-lg text-gray-700')
                                </div>
                                <hr class="mb-4">
                                <div class="flex items-center gap-2 text-sm">
                                    <span>Bạn cần trợ giúp?</span>
                                    <a href="#" class="link-md">Liên hệ với chúng tôi</a>
                                </div>
                            </div>
                            <div class="mb-8">
                                <div class="flex gap-2 items-center">
                                    <input type="text" class="input" placeholder="Mã giảm giá">
                                    <button type="button" class="button-red w-32">Áp dụng</button>
                                </div>
                            </div>
                            <div>
                                <button class="button-red w-full">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

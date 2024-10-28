@extends('layouts.client')

@section('title', 'Thanh toán')

@section('content')
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <div class="card mb-12 p-4 md:p-8">
                <p class="title">THANH TOÁN</p>
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">

                    {{-- Thông tin nhận hàng --}}
                    <div class="col-span-3">
                        <div class="mb-8">
                            <p class="mb-4 font-medium">Thông tin nhận hàng</p>
                            <div class="mb-4">
                                <p class="mb-2 text-sm font-normal" for="">Họ và tên: <span class="text-red-600">*</span></p>
                                <input class="input w-full" name="fullname" type="text" value="{{ old('fullname') ?? Auth::user()->fullname }}">
                                @error('password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <p class="mb-2 text-sm font-normal" for="">Số điện thoại: <span class="text-red-600">*</span></p>
                                <input class="input w-full" name="phone" type="text" value="{{ old('phone') ?? Auth::user()->phone }}">
                                @error('password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <p class="mb-2 text-sm font-normal" for="">Email: <span class="text-red-600">*</span></p>
                                <input class="input w-full" name="email" type="text" value="{{ old('email') ?? Auth::user()->email }}">
                                @error('password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="flex items-end gap-8">
                                    <div>
                                        <p class="mb-2 text-sm font-normal" for="">Chọn địa chỉ: <span class="text-red-600">*</span></p>
                                        <select class="input" id="province" name="province">
                                            <option value="">Nhà riêng</option>
                                            <option value="">Cơ quan</option>
                                            <option value="">Trường học</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center gap-4 mb-2">
                                        <p class="text-sm">Đặt làm mặc định</p>
                                        <label class="inline-flex cursor-pointer items-center">
                                            <input class="peer sr-only" name="email_order" onchange="this.form.submit()" type="checkbox" value="1">
                                            <span class="button-toggle"></span>
                                        </label>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4 grid grid-cols-12 items-center gap-4">
                                <div class="col-span-12 lg:col-span-4">
                                    <p class="mb-2 text-sm font-normal" for="">Tỉnh/Thành phố: <span class="text-red-600">*</span></p>
                                    <input class="input w-full" type="text">
                                    @error('password')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-6 lg:col-span-4">
                                    <p class="mb-2 text-sm font-normal" for="">Quận/Huyện: <span class="text-red-600">*</span></p>
                                    <input class="input w-full" type="text">
                                    @error('password')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-6 lg:col-span-4">
                                    <p class="mb-2 text-sm font-normal" for="">Phường/Xã: <span class="text-red-600">*</span></p>
                                    <input class="input w-full" type="text">
                                    @error('password')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="mb-2 text-sm font-normal" for="">Địa chỉ chi tiết: <span class="text-red-600">*</span>
                                </p>
                                <textarea class="text-area w-full" type="text"></textarea>
                                @error('password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Thanh toán --}}

                    <div class="col-span-2">
                        <div class="mb-16">
                            <p class="mb-4 font-medium">Đơn hàng của bạn</p>
                            <div class="">
                                <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                    <p class="">Tổng tiền sản phẩm</p>
                                    <p class="font-medium">150,000₫</p>
                                </div>
                                <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                    <p class="">Phí vận chuyển</p>
                                    <p class="font-medium">150,000₫</p>
                                </div>
                                <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                    <p class="">Giảm giá</p>
                                    <p class="font-medium">150,000₫</p>
                                </div>
                                <hr class="mb-4">
                                <div class="flex items-center justify-end mb-4 gap-32">
                                    <p class="font-medium">150,000₫</p>
                                </div>
                            </div>
                            <div class="mb-16">
                                <p class="mb-4 font-medium">Phương thức thanh toán</p>
                                <div class="flex items-center justify-between">
                                    <div class="mb-4 flex items-center">
                                        <input class="input-radio me-2" id="default-radio-1" name="default-radio" type="radio" value="">
                                        <label class="text-sm font-normal" for="default-radio-1">Thanh toán khi nhận
                                            hàng</label>
                                    </div>
                                    @svg('tabler-truck', 'icon-lg text-gray-700')
                                </div>
                                <hr class="mb-4">
                                <div class="flex items-center justify-between">
                                    <div class="mb-4 flex items-center">
                                        <input class="input-radio me-2" id="default-radio-1" name="default-radio" type="radio" value="">
                                        <label class="text-sm font-normal" for="default-radio-1">Ví MoMo</label>
                                    </div>
                                    @svg('tabler-credit-card', 'icon-lg text-gray-700')
                                </div>
                                <hr class="mb-4">
                                <div class="flex items-center gap-2 text-sm">
                                    <span>Bạn cần trợ giúp?</span>
                                    <a class="link-md" href="#">Liên hệ với chúng tôi</a>
                                </div>
                            </div>
                            <div class="mb-8">
                                <div class="flex items-center gap-2">
                                    <input class="input" placeholder="Mã giảm giá" type="text">
                                    <button class="button-red w-32" type="button">Áp dụng</button>
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

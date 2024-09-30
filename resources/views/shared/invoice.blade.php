@extends('layouts.shared')

@section('title', 'Hoá đơn')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="mb-8 flex items-center justify-between">
            <p class="title">Hoá đơn</p>
            <button class="button-red">
                @svg('tabler-printer', 'icon-sm md:icon-md md:me-2')
                <span class="hidden md:inline-block">In hoá đơn</span>
            </button>
        </div>
        <div class="card p-4 md:p-8">
            <div class="flex justify-between mb-4 md:mb-8">
                <div class="">
                    <p class="title">COMPANY</p>
                    <div class="text-sm md:text-base">
                        <p>Địa chỉ công ty</p>
                        <p>Thành phố</p>
                        <p>Việt Nam, 03000</p>
                        <p>info@ladybugpizza.com</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="title">đỗ hồng quân</p>
                    <div class="text-sm md:text-base">
                        <p>Số 4 ngách 132/66/2 Nguyên Xá</p>
                        <p>Bắc Từ Liêm, Hà Nội</p>
                        <p>Việt Nam, 50000</p>
                        <p>quandohong28@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="mb-4 md:md-8">
                <p class="title">hoá đơn số INV/001/15</p>
            </div>
            <div class="">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left title-sm">#</th>
                            <th class="text-left title-sm">Sản phẩm</th>
                            <th class="text-right title-sm">Số lượng</th>
                            <th class="text-right title-sm">Đơn giá</th>
                            <th class="text-right title-sm">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody class=>
                        @for ($i = 0; $i < 5; $i++)
                            <tr class="border-b">
                                <td class="text-left py-4 text-sm md:text-base">1</td>
                                <td class="text-left py-4 text-sm md:text-base">
                                    <p class="font-medium">Logo Creation</p>
                                    <p class="font-light">Đế mỏng, Size S</p>
                                    <p class="font-light">Topping: Thịt bò, Hành tây</p>
                                </td>
                                <td class="text-right py-4 text-sm md:text-base">2</td>
                                <td class="text-right py-4 text-sm md:text-base">200,000đ</td>
                                <td class="text-right py-4 text-sm md:text-base">400,000đ</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <div class="text-right">
                    <div class="flex justify-end items-center gap-4 border-b py-2">
                        <p class="font-semibold text-xs md:text-sm lg:text-base">Tạm tính</p>
                        <p class="text-right py-4 text-sm md:text-base">1,600,000đ</p>
                    </div>
                    <div class="flex justify-end items-center gap-4 border-b py-2">
                        <p class="font-semibold text-xs md:text-sm lg:text-base">Phí vận chuyển</p>
                        <p class="text-right py-4 text-sm md:text-base">1,600,000đ</p>
                    </div>
                    <div class="flex justify-end items-center gap-4 border-b py-2">
                        <p class="font-semibold text-xs md:text-sm lg:text-base">Giảm giá</p>
                        <p class="text-right py-4 text-sm md:text-base">1,600,000đ</p>
                    </div>
                    <div class="flex justify-end items-center gap-4 border-b py-2">
                        <p class="font-semibold uppercase">Tổng thanh toán</p>
                        <p class="text-right py-4 text-sm md:text-base">1,600,000đ</p>
                    </div>
                </div>
                <p class="text-center mt-6">Cảm ơn bạn rất nhiều đã đặt hàng tại Ladybug Pizza.Chúng tôi mong được gặp lại
                    bạn một lần nữa!</p>
            </div>
        </div>
    </div>
@endsection

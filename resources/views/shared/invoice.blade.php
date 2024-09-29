@extends('layouts.shared')
@section('title')
    Đây là trang hoá đơn
@endsection
<div class="px-[18px] md:px-[32px] lg:px-[180px] background-white">
    <div class="mt-5 flex items-center mb-4 justify-between">
        <p class="font-bold text-xl sm lg:text-xl md:text-xl">Hoá đơn</p>
        <button
            class="button-red button-sm w-[110px] h-[20px] md:w-[120px] md:h-[30px] lg:w-[128px] lg:h-[32px] text-center flex items-center justify-center sm">In
            hoá đơn</button>
    </div>
    <div class="card lg:h-[1250px] p-[15px] lg:mt-10">
        <div class=" flex justify-between">
            <div class="">
                <p class="font-bold sm lg:text-xl">COMPANY</p>
                <div class=" mt-1 lg:mt-5 font-light sm lg:text-xl">
                    <p>Street address</p>
                    <p>State,City</p>
                    <p>Region, Postal Code</p>
                    <p>ltd@example.com</p>
                </div>
            </div>
            <div class="company text-right">
                <p class="font-bold sm lg:text-xl">CLIENT</p>
                <div class=" mt-1 lg:mt-5 font-light sm lg:text-xl">
                    <p>Street address</p>
                    <p>State,City</p>
                    <p>Region, Postal Code</p>
                    <p>ltd@example.com</p>
                </div>
            </div>
        </div>
        <div class=" py-2 lg:py-8">
            <p class="font-bold sm lg:text-xl">Invoice INV/001/15</p>
        </div>
        <div class="">
            <table class="w-full  mt-1 lg:mt-4">
                <thead>
                    <tr class="border-b">
                        <th class="text-left lg:py-2 py-1 font-medium sm lg:text-xl">#</th>
                        <th class="text-left lg:py-2 py-1 font-medium sm lg:text-xl">Sản phẩm</th>
                        <th class="text-right lg:py-2 py-1 font-medium sm lg:text-xl">Số lượng</th>
                        <th class="text-right lg:py-2 py-1 font-medium sm lg:text-xl">Đơn giá</th>
                        <th class="text-right lg:py-2 py-1 font-medium sm lg:text-xl">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody class=>
                    @for ($i = 0; $i < 5; $i++)
                        <tr class="border-b">
                            <td class="text-left lg:py-4 align-top sm lg:text-xl">1</td>
                            <td class="text-left py-4 sm lg:text-xl">
                                <p class="font-medium">Logo Creation</p>
                                <p class="font-light">Đế mỏng, Size S</p>
                                <p class="font-light">Topping: Thịt bò, Hành tây</p>
                            </td>
                            <td class="text-right py-2 font-light sm lg:text-xl">2</td>
                            <td class="text-right py-2 font-light sm lg:text-xl">200,000đ</td>
                            <td class="text-right py-2 font-light sm lg:text-xl">400,000đ</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <div class="text-right">
                <div class="flex justify-end border-b py-2">
                    <p class="font-medium py-2 text-right flex-grow px-2 md:px-[60px]  lg:px-[90px] sm lg:text-xl">Tạm
                        tính</p>
                    <p class="font-light py-2 text-right sm lg:text-xl">1,600,000đ</p>
                </div>
                <div class="flex justify-end border-b py-2">
                    <p class="font-medium py-2 text-right flex-grow px-2 mr-4 md:px-[60px]  lg:px-[90px] sm lg:text-xl">
                        Phí
                        vận chuyển
                    </p>
                    <p class="font-light py-2 text-right sm lg:text-xl">25,000đ</p>
                </div>
                <div class="flex justify-end border-b py-2">
                    <p class="font-medium py-2 text-right flex-grow px-2 mr-4 md:px-[60px]  lg:px-[90px] sm lg:text-xl">
                        Thuế VAT</p>
                    <p class="font-light py-2 text-right sm lg:text-xl">10,000đ</p>
                </div>
                <div class="flex justify-end border-b py-2">
                    <p class="font-medium py-2 text-right flex-grow px-2 mr-4 md:px-[60px]  lg:px-[90px] sm lg:text-xl">
                        Giảm giá</p>
                    <p class="font-light py-2 text-right sm lg:text-xl">50,000đ</p>
                </div>
                <div class="flex justify-end border-b font-bold py-2">
                    <p class="font-light py-2 text-right flex-grow px-2 mr-4 md:px-[50px]  lg:px-[80px] sm lg:text-xl">
                        TỔNG THANH TOÁN
                    </p>
                    <p class="font-light py-2 text-right sm lg:text-xl">1,585,000đ</p>
                </div>
            </div>

            <p class="mt-5 text-center font-light sm lg:text-xl">Cảm ơn bạn rất nhiều đã đặt hàng tại Ladybugs
                Pizza.Chúng tôi mong được gặp lại bạn một lần nữa!</p>
        </div>
    </div>

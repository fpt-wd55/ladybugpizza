@extends('layouts.client')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="min-h-screen">
        <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
            <div class="mb-8">
                <p class="title">GIỎ HÀNG</p>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="product-card overflow-hidden">
                            <div class="w-full flex justify-between items-center pe-4">
                                <div class="flex gap-4">
                                    <img loading="lazy" src="{{ asset('storage/uploads/products/pizza/pizza_tartufo.png') }}"
                                        class="img-md" alt="">
                                    <div class="text-left py-2">
                                        <p class="font-medium mb-4">Pizza xúc xích</p>
                                        <div class="text-sm">
                                            <p>Đế mỏng, size S</p>
                                            <p>Topping: Thịt bò, cá hồi</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="mb-4 text-sm flex items-center gap-2">
                                        <span class="line-through">320,000đ</span>
                                        <span class="font-medium">300,000đ</span>
                                    </div>
                                    <div class="inline-flex rounded-md shadow-sm" role="group">
                                        <button type="button"
                                            class="px-2 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-red-500">
                                            @svg('tabler-minus', 'icon-sm')
                                        </button>
                                        <div
                                            class="px-4 py-1.5 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200">
                                            1
                                        </div>
                                        <button type="button"
                                            class="px-2 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-red-500">
                                            @svg('tabler-plus', 'icon-sm')
                                        </button>
                                    </div>
                                </div>
                                <a href="#">
                                    @svg('tabler-trash', 'icon-md text-red-600')
                                </a>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Aplly discount code --}}
            <div class="card p-4 md:p-8 mb-12">
                <div class="lg:flex items-center justify-between gap-8 mb-8">
                    <div class="mb-4 md:mb-8 lg:mb-0">
                        <p class="font-medium mb-4">Bạn có mã giảm giá</p>
                        <div class="flex gap-2 items-center">
                            <input type="text" class="input">
                            <button type="button" class="button-red w-32">Áp dụng</button>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-4 gap-32 text-sm">
                            <p class="">Tổng tiền sản phẩm</p>
                            <p class="font-medium">150,000đ</p>
                        </div>
                        <div class="flex items-center justify-between mb-4 gap-32 text-sm">
                            <p class="">Phí vận chuyển</p>
                            <p class="font-medium">150,000đ</p>
                        </div>
                        <div class="flex items-center justify-between mb-4 gap-32 text-sm">
                            <p class="">Giảm giá</p>
                            <p class="font-medium">150,000đ</p>
                        </div>
                        <hr class="mb-4">
                        <div class="flex items-center justify-between mb-4 gap-32">
                            <p class="font-medium">Tổng thanh toán</p>
                            <p class="font-medium">150,000đ</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('client.product.menu') }}" class="button-dark">Tiếp tục mua hàng</a>
                    <a href="{{ route('client.cart.checkout') }}" class="button-red">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
@endsection

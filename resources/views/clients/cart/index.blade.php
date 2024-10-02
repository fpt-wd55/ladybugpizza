@extends('layouts.client')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="min-h-screen">
        <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
            {{-- <div class="space-y-4 pb-12">
                @for ($i = 0; $i < 6; $i++)
                    <div class="product-card overflow-hidden flex justify-between pe-4 items-center">
                        <img src="{{ asset('storage/uploads/products/pizza/pizza_tartufo.png') }}" class="img-md"
                            alt="">
                        <p class="font-medium">Paneer Makhani Pizza</p>
                        <ul class="list-disc text-sm">
                            <li>Đế mỏng, Size S</li>
                            <li>Topping: Thịt bò, Hành tây</li>
                        </ul>
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
                        <div>
                            <p>300,000đ</p>
                        </div>
                        <button class="button-red">
                            @svg('tabler-trash', 'icon-md')
                        </button>
                    </div>
                @endfor
            </div> --}}

            <div class="mb-8">
                <p class="title">GIỎ HÀNG</p>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="product-card overflow-hidden">
                            <div class="w-full flex justify-between items-center pe-4">
                                <div class="flex gap-4">
                                    <img src="{{ asset('storage/uploads/products/pizza/pizza_tartufo.png') }}" class="img-md"
                                        alt="">
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
            <div class="card p-4 md:p-8 mb-12">
                <div class="md:flex items-center justify-between gap-8">
                    <div class="mb-4 md:mb-0">
                        <p class="uppercase font-medium mb-4">Bạn có mã giảm giá</p>
                        <div class="flex gap-2 items-center">
                            <input type="text" class="input">
                            <button type="button" class="button-red w-32">Áp dụng</button>
                        </div>
                    </div>
                    <div class="flex justify-between gap-16">
                        <div class="text-left space-y-2 text-sm font-medium">
                            <p class="">Tổng tiền sản phẩm</p>
                            <p class="">Phí vận chuyển</p>
                            <p class="">Giảm giá</p>
                            <p class="">Tổng thanh toán</p>
                        </div>
                        <div class="text-right text-sm font-medium space-y-2">
                            <p class="">150,000đ</p>
                            <p class="">15,800đ</p>
                            <p class="">23,000đ</p>
                            <p class="">124,000đ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

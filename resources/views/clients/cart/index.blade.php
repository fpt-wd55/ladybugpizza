@extends('layouts.client')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <div class="mb-8">
                <p class="title">GIỎ HÀNG ({{ count($cartItems) }})</p>
                @if (count($cartItems) == 0)
                    <div class="card flex flex-col items-center justify-center gap-8 p-4 md:p-8">
                        @svg('tabler-shopping-bag-exclamation', 'icon-4xl text-gray-400')
                        <p class="text-center">Giỏ hàng của bạn đang trống</p>
                        <a class="button-red" href="{{ route('client.product.menu') }}">Thực đơn</a>
                    </div>
                @endif
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    @foreach ($cartItems as $item)
                        <div class="product-card overflow-hidden">
                            <div class="flex w-full items-start justify-between pe-4">
                                <div class="flex gap-4">
                                    <img alt="" class="img-md min-h-32 lg:min-h-28" loading="lazy" src="{{ asset('storage/uploads/products/tiramisu.jpeg') }}">
                                    <div class="py-2 text-left">
                                        <p class="mb-4 font-medium">{{ $item->product->name }}</p>
                                        <div class="text-sm">
                                            <p class="line-clamp-1">Đế mỏng, size S</p>
                                            <p class="line-clamp-1">Topping: Thịt bò, cá hồi</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 text-right">
                                    <div class="mb-4 flex items-center gap-2">
                                        <span class="text-sm text-gray-600 line-through">{{ number_format($item->price) }}đ</span>
                                        <span class="font-medium">{{ number_format($item->discount_price) }}đ</span>
                                    </div>
                                    <div class="inline-flex rounded-md shadow-sm" role="group">
                                        <button class="rounded-s-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500" id="decrement" type="button">
                                            @svg('tabler-minus', 'icon-sm')
                                        </button>
                                        <input class="w-12 border-b border-t border-gray-200 bg-white px-4 py-1 text-center text-sm font-medium text-gray-900 focus:outline-none" name="quantity" value="1">
                                        <button class="rounded-e-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500" id="increment" type="button">
                                            @svg('tabler-plus', 'icon-sm')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Aplly discount code --}}
            <div class="card mb-12 p-4 md:p-8">
                <div class="mb-8 items-center justify-between gap-8 lg:flex">
                    <div class="mb-4 md:mb-8 lg:mb-0">
                        <p class="mb-4 font-medium">Bạn có mã giảm giá</p>
                        <div class="flex items-center gap-2">
                            <input class="input" type="text">
                            <button class="button-red w-32" type="button">Áp dụng</button>
                        </div>
                    </div>
                    <div>
                        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                            <p class="">Tổng tiền sản phẩm</p>
                            <p class="font-medium">150,000đ</p>
                        </div>
                        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                            <p class="">Phí vận chuyển</p>
                            <p class="font-medium">150,000đ</p>
                        </div>
                        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                            <p class="">Giảm giá</p>
                            <p class="font-medium">150,000đ</p>
                        </div>
                        <hr class="mb-4">
                        <div class="mb-4 flex items-center justify-between gap-32">
                            <p class="font-medium">Tổng thanh toán</p>
                            <p class="font-medium">150,000đ</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2">
                    <a class="button-dark" href="{{ route('client.product.menu') }}">Tiếp tục mua hàng</a>
                    <a class="button-red" href="{{ route('client.cart.checkout') }}">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Lấy các phần tử cần thiết từ DOM
        const decrementButton = document.getElementById('decrement');
        const incrementButton = document.getElementById('increment');
        const quantityInput = document.querySelector('input[name="quantity"]');

        // Thêm sự kiện click cho nút giảm
        decrementButton.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) { // Đảm bảo số lượng không nhỏ hơn 1
                quantity -= 1;
                quantityInput.value = quantity;
            }
        });

        // Thêm sự kiện click cho nút tăng
        incrementButton.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            quantity += 1; // Tăng số lượng lên 1
            quantityInput.value = quantity;
        });
    </script>
@endsection

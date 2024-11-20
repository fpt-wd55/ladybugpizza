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
                    <!-- component -->
                    @foreach ($cartItems as $item)
                        <div class="product-card overflow-hidden">
                            <div class="grid grid-cols-4">
                                <div class="bg-white grid place-items-center">
                                    <img loading="lazy"
                                        src="{{ asset('storage/uploads/products/' . $item->product->image) }}"
                                        class="img-lg h-full object-cover rounded-md">
                                </div>
                                <div class="w-full col-span-3 bg-white flex flex-col space-y-2 ms-3">
                                    <div class="flex justify-between item-center">
                                        <p class="font-bold text-gray-800">{{ $item->product->name }}</p>
                                        <div class="rounded-full text-xs font-medium text-gray-800">
                                            @svg('tabler-trash-x-filled', 'w-6 h-6 text-red-500')
                                        </div>
                                    </div>

                                    <p class="text-sm">
                                        x{{ $item->quantity }}
                                    </p>
                                    <div class="text-sm">
                                        <p class="line-clamp-1">
                                            {{ implode(', ', $item->attributes->pluck('attribute_value.value')->toArray()) }}
                                        </p>
                                        <p class="line-clamp-1">
                                            Topping:
                                            @if (isset($item->toppings))
                                                {{ implode(', ', $item->toppings->pluck('topping.name')->toArray()) }}
                                            @endif
                                        </p>
                                    </div>
                                    <p class="text-lg font-bold text-gray-800">
                                        {{ number_format($item->price) }}₫
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="product-card overflow-hidden">
                            <div class="flex w-full items-start justify-between pe-4">
                                <div class="flex gap-4">
                                    <img loading="lazy" src="{{ asset('storage/uploads/products/tiramisu.jpeg') }}"
                                        class="img-md h-full object-cover">
                                    <div class="text-left py-2">
                                        <div>
                                            <p class="line-clamp-1 font-medium">
                                                {{ $item->product->name }}
                                            </p>
                                            <p class="line-clamp-1 text-sm">
                                                x{{ $item->quantity }}
                                            </p>
                                        </div>
                                        <div class="text-sm">
                                            <p class="line-clamp-1">
                                                {{ implode(', ', $item->attributes->pluck('attribute_value.value')->toArray()) }}
                                            </p>
                                            <p class="line-clamp-1">
                                                Topping:
                                                @if (isset($item->toppings))
                                                    {{ implode(', ', $item->toppings->pluck('topping.name')->toArray()) }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 text-right">
                                    <div class="mb-4">
                                        <span class="font-medium">{{ number_format($item->price) }}₫</span>
                                    </div>
                                    <div class="w-28 inline-block rounded-md">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                </div>
            </div>

            {{-- Aplly discount code --}}
            <div class="card mb-12 p-4 md:p-8">
                <div class="mb-8 items-center justify-between gap-8 lg:flex">
                    <div class="mb-4 md:mb-8 lg:mb-0">
                        <p class="mb-4 font-medium">Bạn có mã giảm giá?</p>
                        <div class="flex items-center gap-2">
                            <input class="input" type="text">
                            <button class="button-red w-32" type="button">Áp dụng</button>
                        </div>
                    </div>
                    <div>
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
                        <div class="mb-4 flex items-center justify-between gap-32">
                            <p class="font-medium">Tổng thanh toán</p>
                            <p class="font-medium">150,000₫</p>
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

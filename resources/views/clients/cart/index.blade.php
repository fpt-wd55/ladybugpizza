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
                        <div class="product-card">
                            <div class="grid grid-cols-4 h-full">
                                <div class="grid place-items-center">
                                    <img loading="lazy"
                                        src="{{ asset('storage/uploads/products/' . $item->product->image) }}"
                                        onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                        class="img-md object-cover rounded-md">
                                </div>
                                <div class="w-full col-span-3 flex flex-col justify-between p-2">
                                    <div class="flex justify-between item-center mb-1">
                                        <p class="font-bold text-gray-800">{{ $item->product->name }}<span
                                                class="text-sm font-normal ps-2">
                                                x{{ $item->quantity }}
                                            </span></p>
                                        <div class="rounded-full text-xs font-medium text-gray-800">
                                            <form action="{{ route('client.product.delete-cart-item', $item) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit">
                                                    @svg('tabler-trash-x-filled', 'w-6 h-6 text-red-500')
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="text-sm">
                                        <p class="line-clamp-1">
                                            {{ implode(', ', $item->attributes->pluck('attribute_value.value')->toArray()) }}
                                        </p>
                                        <p class="line-clamp-1">
                                            @if (isset($item->toppings) && count($item->toppings) > 0)
                                                Topping:
                                                {{ implode(', ', $item->toppings->pluck('topping.name')->toArray()) }}
                                            @endif
                                        </p>
                                    </div>
                                    <p class="font-bold text-gray-800 mt-2">
                                        {{ number_format($item->price) }}₫
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center justify-end gap-2">
                <a class="button-dark" href="{{ route('client.product.menu') }}">Tiếp tục mua hàng</a>
                <a class="button-red" href="{{ route('checkout') }}">Thanh toán</a>
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

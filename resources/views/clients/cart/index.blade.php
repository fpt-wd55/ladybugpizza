@extends('layouts.client')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <div class="mb-8">
                <p class="title">GIỎ HÀNG ({{ count($cartItems) }})</p>
                @if (count($cartItems) == 0)
                    <div class="card min-h-96 flex flex-col items-center justify-center gap-8 p-4 md:p-8">
                        @svg('tabler-shopping-bag-exclamation', 'icon-xl text-gray-400')
                        <p class="text text-center">Giỏ hàng của bạn đang trống</p>
                    </div>
                @else
                    <div class="card min-h-96 gap-8 p-4">
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                            <!-- component -->
                            @foreach ($cartItems as $item)
                                <div class="product-card overflow-hidden">
                                    <div class="grid h-full grid-cols-4">
                                        <div class="">
                                            <img class="img-md min-h-full object-cover" loading="lazy" onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'" src="{{ asset('storage/uploads/products/' . $item->product->image) }}">
                                        </div>
                                        <div class="col-span-3 flex w-full flex-col justify-between p-2 ps-0">
                                            <div class="item-center flex justify-between">
                                                <p class="font-medium text-gray-800">{{ $item->product->name }}
                                                    <span class="ps-2 text-sm font-normal">
                                                        <span>x</span>
                                                        <span>{{ $item->quantity }}</span>
                                                    </span>
                                                </p>
                                                <div class="rounded-full text-xs font-medium text-gray-800">
                                                    <a data-modal-target="deleteCartItemModal-{{ $item->id }}" data-modal-toggle="deleteCartItemModal-{{ $item->id }}" href="#">
                                                        @svg('tabler-trash-x-filled', 'w-6 h-6 text-red-500')
                                                    </a>
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
                                            <p class="mt-2 font-medium text-gray-800">
                                                {{ number_format($item->price) }}₫
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full" id="deleteCartItemModal-{{ $item->id }}" tabindex="-1">
                                    <div class="relative h-auto w-full max-w-md p-4">
                                        <div class="relative rounded-lg bg-white p-4 shadow sm:p-5">
                                            <div class="mb-8 flex flex-col items-center justify-center gap-4 text-sm">
                                                <div>@svg('tabler-alert-triangle', 'icon-2xl text-red-500')</div>
                                                <p>Xác nhận xoá sản phẩm khỏi giỏ hàng</p>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <form action="{{ route('client.product.delete-cart-item', $item) }}" class="w-full" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="button-red w-full" type="submit">
                                                        @svg('tabler-trash-x-filled', 'w-5 h-5')
                                                    </button>
                                                </form>
                                                <button class="button-dark w-full" data-modal-hide="deleteCartItemModal-{{ $item->id }}" type="button">
                                                    Huỷ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
            <div class="flex items-center justify-end gap-2">
                <a class="button-dark" href="{{ route('client.product.menu') }}">Tiếp tục mua hàng</a>
                @if (count($cartItems) > 0)
                    <a class="button-red" href="{{ route('client.checkout') }}">Thanh toán</a>
                @endif

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

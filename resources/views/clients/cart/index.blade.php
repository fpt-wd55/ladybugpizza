@extends('layouts.client')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <div class="mb-8">
                <p class="title mb-8">GIỎ HÀNG ({{ count($cartItems) }})</p>
                <div class="mb-4 flex items-center justify-end">
                    {{-- <div class="mb-4 flex items-center gap-2">
                        <input class="input-checkbox" id="check-all" type="checkbox">
                        <label class="text-sm font-medium text-red-500 hover:cursor-pointer" for="check-all" id="select-all-cart-items">Chọn tất cả</label>
                    </div> --}}
                    @if ($errors->has('quantity'))
                        <p class="text-right text-sm text-red-500">{{ $errors->first('quantity') }}</p>
                    @endif
                </div>
                @if (count($cartItems) == 0)
                    <div class="card min-h-96 flex flex-col items-center justify-center gap-8 p-4 text-gray-500 md:p-8">
                        @svg('tabler-shopping-bag-exclamation', 'icon-xl')
                        <p class="text text-center">Giỏ hàng của bạn đang trống</p>
                        <a class="button-red" href="{{ route('client.product.menu') }}">Thực đơn</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-4">
                        <!-- component -->
                        @foreach ($cartItems as $item)
                            <div class="product-card flex flex-shrink-0 items-center gap-4 overflow-hidden px-4 py-6">
                                {{-- <input class="input-checkbox cart-item-select" name="next-request" type="checkbox"> --}}
                                <div class="h-18 w-18">
                                    <img class="img-md min-h-full min-w-full rounded object-cover" loading="lazy" onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'" src="{{ asset('storage/uploads/products/' . $item->product->image) }}">
                                </div>
                                <div>
                                    <div class="mb-2 flex items-center gap-2">
                                        <a href="{{ route('client.product.show', $item->product->slug) }}">
                                            <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                                        </a>
                                        @if ($item->product->status == 2 || $item->product->delete_at != null || $item->product->category->deleted_at != null)
                                            <span class="badge-red">Ngừng kinh doanh</span>
                                        @elseif ($item->product->quantity <= 0)
                                            <span class="badge-red">Hết hàng</span>
                                        @endif
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
                                    <p class="mt-1 font-medium text-gray-800">
                                        {{ number_format($item->price) }}₫
                                    </p>
                                </div>

                                <div class="ms-auto flex flex-col-reverse items-center justify-center gap-4 lg:flex-row">
                                    <div class="py-1text-right inline-block w-20 overflow-hidden rounded-md border border-gray-200 bg-white py-1 md:w-28">
                                        <form action="{{ route('client.cart.update-cart-item', $item) }}" class="quantity-control flex items-center justify-between" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button aria-label="Decrease" class="size-6 inline-flex items-center justify-center gap-x-2 bg-white text-sm font-medium text-gray-800 disabled:text-gray-300" id="decrement" tabindex="-1" type="button">
                                                @svg('tabler-minus', 'icon-sm')
                                            </button>
                                            <input class="w-6 border-0 bg-transparent p-0 text-center text-sm font-medium text-gray-800 focus:ring-0" min="1" name="quantity" style="appearance: textfield; -moz-appearance: textfield;" type="number" value="{{ $item->quantity }}">
                                            <button aria-label="Increase" class="size-6 inline-flex items-center justify-center gap-x-2 bg-white text-sm font-medium text-gray-800" id="increment" tabindex="-1" type="button">
                                                @svg('tabler-plus', 'icon-sm')
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-auto rounded-full text-xs font-medium text-gray-800">
                                        <a data-modal-target="deleteCartItemModal-{{ $item->id }}" data-modal-toggle="deleteCartItemModal-{{ $item->id }}" href="#">
                                            @svg('tabler-trash', 'w-5 h-5 text-red-500')
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal xoá sản phẩm --}}
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
                                                <button class="button-red w-full" type="submit">Xoá</button>
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
                @endif
            </div>
            @if (count($cartItems) > 0)
                <div class="flex items-center justify-end gap-2">
                    <a class="button-dark" href="{{ route('client.product.menu') }}">Tiếp tục mua hàng</a>
                    <a class="button-red" href="{{ route('checkout') }}">Thanh toán</a>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.querySelectorAll('.quantity-control').forEach(control => {
            const decrementButton = control.querySelector('#decrement');
            const incrementButton = control.querySelector('#increment');
            const quantityInput = control.querySelector('input[name="quantity"]');

            const form = control; // Lấy form cha để submit

            const checkDecrementButton = () => {
                if (parseInt(quantityInput.value) <= 1) {
                    decrementButton.setAttribute('disabled', 'true');
                } else {
                    decrementButton.removeAttribute('disabled');
                }
            };

            // Kiểm tra trạng thái ban đầu
            checkDecrementButton();

            decrementButton.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantity -= 1;
                    quantityInput.value = quantity;
                    checkDecrementButton();
                    form.submit(); // Submit form
                }
            });

            incrementButton.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                quantity += 1;
                quantityInput.value = quantity;
                checkDecrementButton();
                form.submit(); // Submit form
            });

            // Xử lý submit khi người dùng thay đổi trực tiếp input
            quantityInput.addEventListener('change', () => {
                form.submit();
            });
        });
    </script>
@endsection

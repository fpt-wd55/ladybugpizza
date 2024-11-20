@extends('layouts.client')

@section('title', $product->name)

@section('content') 
    <form action="{{ route('client.product.add-to-cart', $product) }}" method="post">
        @method('POST')
        @csrf
        <div class="min-h-screen p-4 transition md:p-8 lg:mx-32">
            <div class="mb-8 grid grid-cols-1 gap-4 md:py-8 lg:grid-cols-5">
                {{-- Product detail --}}
                <div class="col-span-5 mb-8 md:flex md:gap-8 lg:col-span-2 lg:block">
                    <div class="mb-8 md:h-80 md:w-80">
                        <a data-fslightbox="gallery" href="{{ asset('storage/uploads/products/' . $product->image) }}">
                            <img alt="{{ $product->name }}" class="w-full rounded-lg object-cover" loading="lazy"
                                src="{{ asset('storage/uploads/products/' . $product->image) }}" />
                        </a>
                    </div>
                    <div>
                        <h1 class="mb-4 text-xl font-medium uppercase md:text-2xl">{{ $product->name }}</h1>
                        <div class="mb-2 flex items-center gap-2">
                            <div class="flex items-center gap-1">
                                @for ($i = 0; $i < 5; $i++)
                                    @svg($i < $product->avg_rating ? 'tabler-star-filled' : 'tabler-star', 'icon-md text-red-500')
                                @endfor
                            </div>
                            <p>({{ $product->avg_rating }})</p>
                        </div>
                        <p class="comfortable pe-8">{!! $product->description !!}</p>
                    </div>
                </div>

                {{-- Thuộc tính --}}
                <div class="col-span-5 md:col-span-3">
                    @foreach ($attributes as $attribute)
                        <div class="mb-8">
                            <p class="mb-4 text-lg font-medium">
                                <span class="text-red-500">*</span>
                                {{ $attribute->name }}
                            </p>
                            <div class="flex flex-wrap items-center gap-4 md:gap-8">
                                @foreach ($attribute->values as $index => $value)
                                    <div class="min-w-32">
                                        <input {{ $index === 0 ? 'checked' : '' }} class="peer hidden"
                                            id="attribute_{{ $value->id }}" name="attributes[{{ $attribute->slug }}]"
                                            data-price="{{ $value->price }}" data-type="{{ $value->price_type }}" required
                                            type="radio" value="{{ $value->id }}" />
                                        <label class="label-peer flex flex-col items-center gap-2"
                                            for="attribute_{{ $value->id }}">
                                            <p class="text-sm font-medium">{{ $value->value }}</p>
                                            {{-- <p class="text-sm">+ {{ number_format($value->price($product)) }}đ</p> --}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{-- Toppings --}}
                    @if ($toppings->count() > 0)
                        <div class="mb-8">
                            <p class="mb-4 text-lg font-medium">
                                Hương vị đậm đà hơn với topping tuỳ chỉnh
                            </p>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($toppings as $topping)
                                    <div>
                                        <input class="peer hidden" id="{{ $topping->slug }}" name="toppings[]"
                                            data-price="{{ $topping->price }}" type="checkbox"
                                            value="{{ $topping->id }}">
                                        <label
                                            class="flex w-full cursor-pointer items-center justify-start gap-2 overflow-hidden rounded-lg border border-gray-200 bg-white p-2 text-gray-700 transition hover:bg-gray-50 hover:text-gray-600 peer-checked:border-red-600 peer-checked:text-red-600 md:gap-4"
                                            for="{{ $topping->slug }}">
                                            <img alt="{{ $topping->name }}"
                                                class="h-16 w-16 flex-shrink-0 rounded-lg object-cover" loading="lazy"
                                                src="{{ asset('storage/uploads/toppings/' . $topping->image) }}">
                                            <div class="text-sm">
                                                <p class="mb-2 font-medium">{{ $topping->name }}</p>
                                                <p>+ {{ number_format($topping->price) }} đ</p>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                </div>

                {{-- Đánh giá --}}
                <div class="card col-span-5 p-4 md:p-8">
                    <p class="title">Đánh giá sản phẩm</p>
                    @foreach ($evaluations as $evaluation)
                        <div class="mb-12">
                            {{-- info --}}
                            <div class="mb-4 flex items-center gap-4">
                                <img alt="" class="img-circle img-sm" loading="lazy"
                                    src="{{ $evaluation->user->avatar() }}">
                                <div>
                                    <div class="mb-1 flex items-center gap-2">
                                        <p class="text-sm font-medium">{{ $evaluation->user->fullname }}</p>
                                        <div class="flex items-center gap-1">
                                            @svg('tabler-star-filled', 'icon-sm text-red-500')
                                            @svg('tabler-star-filled', 'icon-sm text-red-500')
                                            @svg('tabler-star-filled', 'icon-sm text-red-500')
                                            @svg('tabler-star-filled', 'icon-sm text-red-500')
                                            @svg('tabler-star', 'icon-sm text-red-500')
                                        </div>
                                    </div>
                                    <p class="text-sm">{{ $evaluation->created_at }}</p>
                                </div>
                            </div>
                            {{-- content --}}
                            <div class="mb-4 px-14">
                                <p class="mb-4 text-sm">{{ $evaluation->comment }}</p>
                                <div class="no-scrollbar flex w-full items-center gap-4 overflow-x-auto">
                                    @for ($i = 0; $i < 5; $i++)
                                        <a class="min-w-16 min-h-16 max-w-16 max-h-16 overflow-hidden"
                                            data-fslightbox="gallery"
                                            href="{{ asset('storage/uploads/products/tiramisu.jpeg') }}">
                                            <img class="w-full rounded object-cover" loading="lazy"
                                                src="{{ asset('storage/uploads/products/tiramisu.jpeg') }}">
                                        </a>
                                    @endfor
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Add to card bar --}}
        <div class="sticky bottom-16 w-full border-t bg-white p-4 transition lg:bottom-0 lg:px-32">
            <div class="grid grid-cols-3 items-center justify-between">
                <div class="w-28 py-2 px-3 inline-block bg-white border border-gray-200 rounded-md">
                    <div class="flex items-center gap-x-1.5">
                        <button type="button" id="decrement"
                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                            tabindex="-1" aria-label="Decrease">
                            @svg('tabler-minus', 'icon-sm')
                        </button>
                        <input
                            class="p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                            name="quantity" style="-moz-appearance: textfield;" type="number" value="1">
                        <button type="button" id="increment"
                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                            tabindex="-1" aria-label="Increase">
                            @svg('tabler-plus', 'icon-sm')
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-4">
                    <p class="text-sm line-through">{{ number_format($product->discount_price) }}đ</p>
                    <p class="text-lg md:text-xl font-semibold" id="price">{{ number_format($product->price) }}đ</p>
                </div>

                <div class="flex items-center justify-end gap-2">
                    <a class="{{ $favorites->contains($product->id) ? 'button-red' : 'button-light' }}"
                        href="{{ route('client.product.post-favorite', $product->slug) }}" type="submit">
                        @svg('tabler-heart', 'md:me-2 icon-sm')
                        <span class="hidden md:block">
                            {{ $favorites->contains($product->id) ? 'Đã yêu thích' : 'Yêu thích' }}
                        </span>
                    </a>

                    <button class="button-red" type="submit">
                        @svg('tabler-shopping-bag-plus', 'md:me-2 icon-sm')
                        <span class="hidden md:block">Thêm vào giỏ hàng</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
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

        // Cập nhật giá sản phẩm khi thay đổi
        document.addEventListener('DOMContentLoaded', function() {
            const priceElement = document.getElementById('price');
            const originalPrice = parseInt(priceElement.innerText.replace(/\D/g, '')); // Giá gốc của sản phẩm
            const attributes = document.querySelectorAll('input[name^="attributes"]');
            const toppings = document.querySelectorAll('input[name^="toppings[]"]');

            const updatePrice = () => {
                let totalExtraPrice = 0;

                attributes.forEach(attribute => {
                    if (attribute.checked) {
                        const priceValue = parseInt(attribute.getAttribute('data-price'));
                        const priceType = attribute.getAttribute('data-type');
                        let extraPrice = 0;

                        if (priceType === '1') {
                            extraPrice = priceValue;
                        } else {
                            extraPrice = originalPrice * priceValue / 100;
                        }

                        totalExtraPrice += extraPrice;
                    }
                });

                toppings.forEach(topping => {
                    if (topping.checked) {
                        totalExtraPrice += parseInt(topping.getAttribute('data-price'));
                    }
                });

                priceElement.innerText = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(originalPrice + totalExtraPrice);
            };

            attributes.forEach(attribute => {
                attribute.addEventListener('change', updatePrice);
            });

            toppings.forEach(topping => {
                topping.addEventListener('change', updatePrice);
            });

            updatePrice();
        });
    </script>

@endsection

@extends('layouts.client')

@section('title', 'Chi tiết sản phẩm')

@section('content')

    <form action="{{ route('client.product.add-to-cart', $product->slug) }}" method="post">
        @method('POST')
        @csrf
        <div class="min-h-screen p-4 transition md:p-8 lg:mx-32">
            <div class="mb-8 grid grid-cols-1 gap-4 md:py-8 lg:grid-cols-5">
                {{-- Product detail --}}
                <div class="col-span-5 mb-8 md:flex md:gap-8 lg:col-span-2 lg:block">
                    <div class="mb-8 md:h-80 md:w-80">
                        <a data-fslightbox="gallery" href="{{ asset('storage/uploads/products/' . $product->image) }}">
                            <img alt="{{ $product->name }}" class="w-full rounded-lg object-cover" loading="lazy" src="{{ asset('storage/uploads/products/' . $product->image) }}" />
                        </a>
                    </div>
                    <div>
                        <p class="mb-4 text-xl font-medium uppercase md:text-2xl">{{ $product->name }}</p>
                        <div class="mb-2 flex items-center gap-2">
                            <div class="flex items-center gap-1">
                                @for ($i = 0; $i < 5; $i++)
                                    @svg($i < $product->avg_rating ? 'tabler-star-filled' : 'tabler-star', 'icon-md text-red-500')
                                @endfor
                            </div>
                            <p>({{ $product->avg_rating }})</p>
                        </div>
                        <p class="comfortable pe-8">{{ $product->description }}</p>
                    </div>
                </div>

                {{-- attributes --}}
                <div class="col-span-5 md:col-span-3">
                    @foreach ($attributes as $attribute)
                        <div class="mb-8">
                            <p class="mb-4 font-medium text-lg">
                                <span class="text-red-500">*</span>
                                {{ $attribute->name }}
                            </p>
                            <div class="flex flex-wrap items-center gap-4 md:gap-8">
                                @foreach ($attribute->values as $index => $value)
                                    <div class="min-w-32">
                                        <input {{ $index === 0 ? 'checked' : '' }} class="peer hidden" id="attribute_{{ $value->id }}" name="attributes[{{ $attribute->slug }}]" required type="radio" value="{{ $value->id }}" />
                                        <label class="label-peer flex flex-col items-center gap-2" for="attribute_{{ $value->id }}">
                                            <p class="text-sm font-medium">{{ $value->value }}</p>
                                            <p class="text-sm">+ {{ number_format($value->price($product)) }}₫</p>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{-- toppings --}}
                    <div class="mb-8">
                        <p class="mb-4 font-medium text-lg">
                            Hương vị đậm đà hơn với topping tuỳ chỉnh
                        </p>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($toppings as $topping)
                                <div>
                                    <input class="peer hidden" id="{{ $topping->slug }}" name="toppings[]" type="checkbox" value="{{ $topping->id }}">
                                    <label class="flex w-full cursor-pointer items-center justify-start gap-2 overflow-hidden rounded-lg border border-gray-200 bg-white p-2 text-gray-700 transition hover:bg-gray-50 hover:text-gray-600 peer-checked:border-red-600 peer-checked:text-red-600 md:gap-4" for="{{ $topping->slug }}">
                                        <img alt="{{ $topping->name }}" class="h-16 w-16 flex-shrink-0 rounded-lg object-cover" loading="lazy" src="{{ asset('storage/uploads/toppings/' . $topping->image) }}">
                                        <div class="text-sm">
                                            <p class="mb-2 font-medium">{{ $topping->name }}</p>
                                            <p>+ {{ number_format($topping->price) }} ₫</p>
                                        </div>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>


                {{-- Evaluation --}}
                <div class="card col-span-5 p-4 md:p-8">
                    <p class="title">Đánh giá sản phẩm</p>
                    @foreach ($evaluations as $evaluation)
                        <div class="mb-12">
                            {{-- info --}}
                            <div class="mb-4 flex items-center gap-4">
                                <img alt="" class="img-circle img-sm" loading="lazy" src="{{ $evaluation->user->avatar() }}">
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
                                        <a class="min-w-16 min-h-16 max-w-16 max-h-16 overflow-hidden" data-fslightbox="gallery" href="{{ asset('storage/uploads/products/tiramisu.jpeg') }}">
                                            <img class="w-full rounded object-cover" loading="lazy" src="{{ asset('storage/uploads/products/tiramisu.jpeg') }}">
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
            <div class="flex items-center justify-between">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button class="rounded-s-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500" id="decrement" type="button">
                        @svg('tabler-minus', 'icon-sm')
                    </button>
                    <input class="w-12 border-b border-t border-gray-200 bg-white px-4 py-1 text-center text-sm font-medium text-gray-900 focus:outline-none" name="quantity" value="1">
                    <button class="rounded-e-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500" id="increment" type="button">
                        @svg('tabler-plus', 'icon-sm')
                    </button>
                </div>

                <div class="flex items-center justify-center gap-4">
                    <p class="text-sm line-through">175,000₫</p>
                    <p class="text-lg font-semibold">143,000₫</p>
                </div>

                <div class="flex items-center justify-end gap-2">
                    <a class="{{ $favorites->contains($product->id) ? 'button-red' : 'button-light' }}" href="{{ route('client.product.post-favorite', $product->slug) }}" type="submit">
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
    </script>

@endsection

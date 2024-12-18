@extends('layouts.client')

@section('title', $product->name)

@section('content')
    <form action="{{ route('client.product.add-to-cart', $product) }}" method="post">
        @csrf
        @method('POST')
        <div class="min-h-screen p-4 transition md:p-8 lg:mx-32">
            <div class="mb-8 grid grid-cols-1 lg:grid-cols-5">
                {{-- Product detail --}}
                <div class="product-detail-box col-span-5 rounded-l-lg md:flex md:gap-8 lg:col-span-2 lg:block">
                    <div class="md:max-w-80 mb-8 md:max-h-80">
                        <a data-fslightbox="gallery" href="{{ asset('storage/uploads/products/' . $product->image) }}">
                            <img alt="{{ $product->name }}" class="w-full rounded-lg object-cover"
                                 class="mr-3 rounded bg-slate-400 object-cover" loading="lazy"
                                 onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                 src="{{ asset('storage/uploads/products/' . $product->image) }}"/>
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
                            <a href="#comment"><p>({{ $product->evalutions->count() }})</p></a>
                        </div>
                        <p class="comfortable pe-8 text-sm">{!! $product->description !!}</p>
                    </div>
                </div>

                {{-- Thuộc tính --}}
                <div class="col-span-5 rounded-r-lg p-5 md:col-span-3" style="background-color: #fbfbfb">
                    @foreach ($attributes as $attribute)
                        <div class="mb-8">
                            <p class="mb-4 text-lg font-medium">
                                <span class="text-red-500">*</span>
                                {{ $attribute->name }}
                            </p>
                            <div class="flex flex-wrap items-center gap-4 md:gap-8">
                                @foreach ($attribute->values as $index => $value)
                                    <div class="min-w-32 {{ $value->quantity <= 0 ? 'out-of-stock' : '' }}">
                                        <input
                                            {{ old('attributes_' . $attribute->slug) == $value->id ? 'checked' : '' }} class="peer hidden"
                                            data-price="{{ $value->price }}" data-type="{{ $value->price_type }}"
                                            id="attribute_{{ $value->id }}" name="attributes_{{ $attribute->slug }}"
                                            type="radio" value="{{ $value->id }}"/>
                                        <label class="label-peer flex flex-col items-center gap-2"
                                               for="attribute_{{ $value->id }}">
                                            <p class="text-sm font-medium">{{ $value->value }}</p>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('attributes_' . $attribute->slug)
                            <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                            @enderror
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
                                        <input class="peer hidden" data-price="{{ $topping->price }}"
                                               id="{{ $topping->slug }}" name="toppings[]" type="checkbox"
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
                            @error('toppings')
                            <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>
            <div class="mb-8 grid grid-cols-1 gap-4 lg:grid-cols-5" id="comment">
                {{-- Đánh giá --}}
                <div class="card col-span-5 p-4 md:p-8">
                    <p class="title">Đánh giá sản phẩm</p>
                    @forelse ($evaluations as $evaluation)
                        <div class="my-5">
                            {{-- info --}}
                            <div class="mb-4 flex items-center gap-4">
                                <img alt="" class="img-circle img-sm" loading="lazy"
                                     src="{{ $evaluation->user->avatar() }}">
                                <div>
                                    <div class="mb-1 flex items-center gap-2">
                                        <p class="text-sm font-medium">{{ $evaluation->user->fullname }} |
                                            {{ $evaluation->created_at->format('d-m-Y H:i') }}</p>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $evaluation->rating)
                                                @svg('tabler-star-filled', 'icon-sm text-red-500')
                                            @else
                                                @svg('tabler-star', 'icon-sm text-red-500')
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            {{-- content --}}
                            <div class="px-14">
                                <p class="mb-4 text-sm">{{ $evaluation->comment }}</p>
                            </div>
                            <hr>
                        </div>
                    @empty
                        <td class="py-4 text-center text-base" colspan="6">
                            <div class="flex h-80 w-full flex-col items-center justify-center rounded-lg bg-white p-6">
                                <p class="mt-4 text-sm text-gray-500">Sản phẩm chưa có đánh giá</p>
                            </div>
                        </td>
                    @endforelse
                    <div class="p-4">
                        {{ $evaluations->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Add to card bar --}}
        <div class="sticky bottom-16 w-full border-t bg-white p-4 transition md:px-32 lg:bottom-0">
            <div class="grid grid-cols-3 items-center justify-between">
                @if ($product->status != 1 || $product->category->deleted_at != null)
                    <div>
                        <p class="text-sm text-[#D30A0A]">Sản phẩm đã tạm ngưng kinh doanh</p>
                    </div>
                @else
                    <div class="block items-center justify-start md:flex">
                        <div class="inline-block w-20 rounded-md border border-gray-200 bg-white px-3 py-2 md:w-28">
                            <div class="flex items-center justify-center gap-x-1.5">

                                <button aria-label="Decrease"
                                        class="size-6 inline-flex items-center justify-center gap-x-2 bg-white text-sm font-medium text-gray-800 disabled:text-gray-300"
                                        id="decrement" tabindex="-1" type="button">
                                    @svg('tabler-minus', 'icon-sm')
                                </button>
                                <input
                                    class="w-6 border-0 bg-transparent p-0 text-center text-sm font-medium text-gray-800 focus:ring-0"
                                    min="1" name="quantity" style="appearance: textfield; -moz-appearance: textfield;"
                                    type="hidden" value="1" id="quantity">
                                <p id="show_quantity"
                                   class="w-6 border-0 bg-transparent p-0 text-center text-sm font-medium text-gray-800 focus:ring-0"></p>
                                <button aria-label="Increase"
                                        class="size-6 inline-flex items-center justify-center gap-x-2 bg-white text-sm font-medium text-gray-800"
                                        id="increment" tabindex="-1" type="button">
                                    @svg('tabler-plus', 'icon-sm')
                                </button>
                            </div>
                        </div>
                        @error('quantity')
                        <p class="py-2 text-sm text-red-600 md:p-0 md:ps-5">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <div class="flex items-center justify-center gap-4">
                    @if ($product->discount_price == 0)
                        <p class="text-lg font-semibold md:text-xl" id="price">
                            {{ number_format($product->price) }}đ</p>
                    @else
                        <p class="text-sm line-through">{{ number_format($product->price) }}đ</p>
                        <p class="text-lg font-semibold md:text-xl" id="price">
                            {{ number_format($product->discount_price) }}đ</p>
                    @endif
                </div>

                <div class="flex items-center justify-end gap-1 md:gap-2">
                    <a class="{{ $favorites->contains($product->id) ? 'button-red' : 'button-light' }}"
                       href="{{ route('client.product.post-favorite', $product->slug) }}" type="submit">
                        @svg('tabler-heart', 'md:me-2 icon-sm')
                        <span class="hidden md:block">
                            {{ $favorites->contains($product->id) ? 'Đã yêu thích' : 'Yêu thích' }}
                        </span>
                    </a>
                    @if ($product->status != 1)
                        <div></div>
                    @else
                        <button class="button-red" type="submit">
                            @svg('tabler-shopping-bag-plus', 'md:me-2 icon-sm')
                            <span class="hidden md:block">Thêm vào giỏ hàng</span>
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </form>
    @if ($product->status == 1)
        <script>
            // Lấy các phần tử cần thiết từ DOM
            const decrementButton = document.getElementById('decrement');
            const incrementButton = document.getElementById('increment');
            const quantityInput = document.querySelector('input[name="quantity"]');
            const showQuantity = document.getElementById('show_quantity');
            showQuantity.innerText = quantityInput.value;

            // Thêm sự kiện click cho nút giảm
            decrementButton.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    // Đảm bảo số lượng không nhỏ hơn 1
                    quantity -= 1;
                    quantityInput.value = quantity;
                    showQuantity.innerText = quantity;
                }
            });

            // Thêm sự kiện click cho nút tăng
            incrementButton.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                quantity += 1; // Tăng số lượng lên 1
                quantityInput.value = quantity;
                showQuantity.innerText = quantity;
            });
        </script>
    @endif
@endsection
@section('scripts')
    <script>
        // Cập nhật giá sản phẩm khi thay đổi
        document.addEventListener('DOMContentLoaded', function () {
            const priceElement = document.getElementById('price');
            const originalPrice = parseInt(priceElement.innerText.replace(/\D/g, ''));
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

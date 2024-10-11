@extends('layouts.client')

@section('title', 'Thực đơn')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="grid grid-cols-3 md:gap-8">

            {{-- Sản phẩm --}}
            <div class="col-span-3">

                {{-- combo --}}
                <div class="mb-8">
                    <p class="font-semibold uppercase mb-4">Combo</p>

                    <div class="flex items-center gap-4 overflow-x-auto w-full">
                        @foreach ($combos as $combo)
                            <a href="" class="product-card flex overflow-hidden relative flex-shrink-0 w-2/3">
                                <img loading="lazy" src="{{ asset('storage/uploads/products/combo/combo.jpeg') }}" class="flex-shrink-0 h-60 w-1/2 object-cover" alt="">
                                <div class="p-4">
                                    <p class="font-semibold mb-2 text-sm md:text-base">{{ $combo->name }}</p>
                                    <ul class="ps-4 text-xs md:text-sm space-y-1 list-disc">
                                        <li>Pizza xúc xích phô mai size S</li>
                                        <li>Pizza xúc xích phô mai size M</li>
                                        <li>2 Pepsi lon 450ml</li>
                                    </ul>
                                    <div class="absolute bottom-4 flex gap-3 items-center">
                                        <p class="line-through text-sm text-gray-500">190,000đ</p>
                                        <p class="text-lg font-semibold">190,000đ</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Categories --}}
                <div class="flex flex-wrap items-center gap-8 md:justify-between mb-4 md:mb-8 py-8">
                    @foreach ($categories as $category)
                        @if ($category->id == 7)
                            @continue
                        @endif
                        <a href="{{ route('client.product.menu') . '#' . $category->slug }}" class="flex flex-col items-center justify-center">
                            <img src="{{ asset('storage/uploads/categories/' . $category->image) }}" class="w-12 h-12 object-cover hover:transform hover:scale-110 transition-transform mb-2" alt="">
                            <p class="font-normal md:text-sm text-xs">{{ $category->name }}</p>
                        </a>
                    @endforeach
                </div>

                {{-- products --}}
                <div class="mb-8">
                    @foreach ($categories as $category)
                        @if ($category->id == 7)
                            @continue
                        @endif

                        <p id="{{ $category->slug }}" class="font-semibold uppercase mb-4">{{ $category->name }}</p>

                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-4 md:mb-8 lg:mb-16">
                            @foreach ($products as $product)
                                @if ($product->category_id == $category->id)
                                    <a href="{{ route('client.product.show', $product->slug) }}" class="product-card md:flex overflow-hidden">
                                        <img loading="lazy" src="{{ asset('storage/uploads/products/' . $product->category->slug . '/' . $product->image) }}" class="flex-shrink-0 h-48 w-full md:w-1/3 md:h-full object-cover" alt="{{ $product->image }}">
                                        <div class="p-2 text-sm">
                                            <p class="font-semibold mb-2 ">{{ $product->name }}</p>
                                            <div class="flex items-center gap-1 mb-2">
                                                <p>{{ $product->avg_rating }}</p>
                                                <div class="flex items-center gap-1">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @svg($i < $product->avg_rating ? 'tabler-star-filled' : 'tabler-star', 'icon-sm text-red-500')
                                                    @endfor
                                                </div>
                                                <p>({{ $product->avg_rating }})</p>
                                            </div>
                                            <p class="mb-4 line-clamp-3 h-12">{{ $product->description }}</p>
                                            <div class="bottom-4 flex gap-3 items-center">
                                                <p class="line-through text-xs text-gray-500">
                                                    {{ number_format($product->price) }}đ
                                                </p>
                                                <p class="font-semibold">{{ number_format($product->discount_price) }}đ</p>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

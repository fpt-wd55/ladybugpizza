@extends('layouts.client')

@section('title', 'Thực đơn')

@section('content')
<div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
    <div class="grid grid-cols-3 md:gap-8">

        {{-- Sản phẩm --}}
        <div class="col-span-3">

            {{-- Categories --}}
            <div class="mt-12 py-8 text-center">
                <p class="vujahday-script-regular mb-6 text-center text-6xl">Menu</p>
                <p class="mb-12 uppercase text-gray-500">Ngon đến từng miếng, đậm vị yêu thương</p>
                @include('partials.clients.categories')
            </div>
            {{-- combo --}}
            <div class="mb-8">
                {{-- <p class="font-semibold uppercase mb-4">Combo</p> --}}
                <div class="no-scrollbar flex w-full items-center gap-4 overflow-x-auto">
                    @foreach ($combos as $combo)
                    <a class="product-card relative flex w-full flex-shrink-0 overflow-hidden md:w-2/3" href="">
                        <img alt="" class="h-60 w-1/2 flex-shrink-0 object-cover" loading="lazy" src="{{ asset('storage/uploads/products', $combo->image) }}">
                        <div class="p-4">
                            <p class="mb-2 text-sm font-semibold md:text-base">{{ $combo->name }}</p>
                            <ul class="list-disc space-y-1 ps-4 text-xs md:text-sm">
                                <li>Pizza xúc xích phô mai size S</li>
                                <li>Pizza xúc xích phô mai size M</li>
                                <li>2 Pepsi lon 450ml</li>
                            </ul>
                            <div class="absolute bottom-4 flex items-center gap-3">
                                <p class="text-sm text-gray-500 line-through">190,000đ</p>
                                <p class="text-lg font-semibold">190,000đ</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- products --}}
            <div class="mb-8">
                @foreach ($categories as $category)
                @if ($category->id == 7)
                @continue
                @endif

                <p class="mb-4 font-semibold uppercase" id="{{ $category->slug }}">{{ $category->name }}</p>

                <div class="mb-8 grid grid-cols-2 gap-4 lg:mb-16 lg:grid-cols-3">
                    @foreach ($products as $product)
                    @if ($product->category_id == $category->id)
                    <a class="product-card overflow-hidden md:flex" href="{{ route('client.product.show', $product->slug) }}">
                        <img alt="{{ $product->image }}" class="h-48 w-full flex-shrink-0 object-cover md:h-full md:w-1/3" loading="lazy" src="{{ asset('storage/uploads/products/' . $product->image) }}">
                        <div class="p-2 text-sm">
                            <p class="mb-2 font-semibold">{{ $product->name }}</p>
                            <div class="mb-2 flex items-center gap-1">
                                <p>{{ $product->avg_rating }}</p>
                                <div class="flex items-center gap-1">
                                    @for ($i = 0; $i < 5; $i++) @svg($i < $product->avg_rating ? 'tabler-star-filled' : 'tabler-star', 'icon-sm text-red-500')
                                        @endfor
                                </div>
                                <p>({{ $product->avg_rating }})</p>
                            </div>
                            <p class="mb-4 line-clamp-3 h-12">{{ $product->description }}</p>
                            <div class="bottom-4 flex items-center gap-3">
                                <p class="text-xs text-gray-500 line-through">
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

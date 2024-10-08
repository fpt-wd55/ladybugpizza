@extends('layouts.client')

@section('title', 'Thực đơn')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="grid grid-cols-3 md:gap-8">
            {{-- Bộ lọc --}}
            <div class="col-span-3 lg:col-span-1 card p-4 mb-8">
                <p class="font-semibold uppercase flex items-center gap-2 mb-4">
                    @svg('tabler-filter', 'icon-md')
                    Bộ lọc
                </p>
                {{-- Tìm kiếm --}}
                <form class="mb-4" action="{{ route('client.product.menu') }}">
                    <input type="text" name="search" placeholder="Tìm kiếm..." class="input mb-4" />
                    <button type="submit" class="button-red w-full">Tìm kiếm</button>
                </form>
                <hr class="hr-default" />

                <form action="{{ route('client.product.menu') }}">
                    <button type="submit" class="text-white rounded px-4 py-2 mb-8 w-full button-red ">Áp dụng bộ
                        lọc</button>

                    {{-- Giá --}}
                    <div class="mb-4">
                        <h3 class="font-semibold mb-2 uppercase text-sm">Giá</h3>
                        <div class="flex items-center justify-between gap-8">
                            <input type="text" class="input text-sm" placeholder="Tối thiểu">
                            <span>-</span>
                            <input type="text" class="input text-sm" placeholder="Tối đa">
                        </div>

                    </div>
                    <hr class="hr-default" />

                    {{-- Danh mục --}}
                    <div class="mb-4 md:flex md:items-start">
                        <div class="md:flex-1">
                            <p class="font-semibold mb-2 uppercase text-sm">Danh mục</p>
                            <div class="space-y-2">
                                @foreach ($categories as $category)
                                    <label class="flex items-center gap-2 text-sm">
                                        <input name="category" value="{{ $category->id }}" type="radio"
                                            @checked($category->id == request('category')) class="input-radio" />
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <hr class="hr-default" />
                    {{-- Đánh giá --}}
                    <div class="mb-4 ">
                        <h3 class="font-semibold mb-2 uppercase text-sm">Đánh giá</h3>
                        <div>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" class="input-checkbox" /> 5 sao
                                </label>
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" class="input-checkbox" /> Từ 4 sao
                                </label>
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" class="input-checkbox" /> Từ 3 sao
                                </label>
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" class="input-checkbox" /> Từ 2 sao
                                </label>
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" class="input-checkbox" /> Từ 1 sao
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Sản phẩm --}}
            <div class="col-span-3 lg:col-span-2">
                {{-- combo --}}
                <div class="mb-8">
                    <p class="font-semibold uppercase mb-4">Combo</p>
                    <a href="" class="product-card flex overflow-hidden relative">
                        <img src="{{ asset('storage/uploads/products/combo/combo.jpeg') }}"
                            class="flex-shrink-0 h-60 w-1/2 object-cover" alt="">
                        <div class="p-4">
                            <p class="font-semibold mb-2 text-sm md:text-base">Combo 2 Pizza + Pepsi - Ăn thả ga - Giá siêu
                                rẻ</p>
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
                </div>

                {{-- products --}}
                <div class="mb-8">
                    <p class="font-semibold uppercase mb-4">Pizza</p>
                    <div class="grid grid-cols-2 lg:grid-cols-2 gap-4 mb-4">
                        @foreach ($products as $product)
                            <a href="{{ route('client.product.show', $product->slug) }}"
                                class="product-card md:flex overflow-hidden">
                                <img src="{{ asset('storage/uploads/products/' . $product->category->slug . '/' . $product->image) }}"
                                    class="flex-shrink-0 h-48 w-full md:w-1/3 md:h-full object-cover"
                                    alt="{{ $product->image }}">
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
                        @endforeach
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

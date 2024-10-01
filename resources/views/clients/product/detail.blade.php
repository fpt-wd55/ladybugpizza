@extends('layouts.client')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="card p-4 md:p-8 flex gap-4 md:gap-8">
            <div>
                <img src="{{ asset('storage/uploads/products/pizza/pizza_francaise.jpeg') }}" alt="{{ $product->name }}"
                    class="w-80 h-80 object-cover rounded-lg mb-4" />
                <div>
                    <p class="title">{{ $product->name }}</p>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="flex items-center gap-1">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $product->avg_rating)
                                    @svg('tabler-star-filled', 'icon-sm text-red-500')
                                @else
                                    @svg('tabler-star', 'icon-sm text-red-500')
                                @endif
                            @endfor
                        </div>
                        <p>({{ $product->avg_rating }})</p>
                    </div>
                    <p class="">{{ $product->description }}</p>
                </div>
            </div>

            <div>
                
            </div>

        </div>
    </div>

    <div class="border-t sticky bottom-0 w-full bg-white transition md:px-24 lg:px-32 p-4">
        <div class="flex items-center justify-between">


            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-red-500">
                    @svg('tabler-minus', 'icon-sm')
                </button>
                <div class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200">
                    1
                </div>
                <button type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-red-500">
                    @svg('tabler-plus', 'icon-sm')
                </button>
            </div>

            <p class="font-semibold text-lg">100,000đ</p>

            <button class="button-red">
                @svg('tabler-shopping-bag-plus', 'me-2 icon-md')
                Thêm vào giỏ hàng
            </button>
        </div>
    </div>
@endsection

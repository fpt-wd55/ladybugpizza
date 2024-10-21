@extends('layouts.client')

@section('title', 'Chi tiết sản phẩm')

@section('content')

    <form action="{{ route('client.product.add-to-cart', $product->slug) }}" method="post">
        @csrf
        @method('POST')
        <div class="min-h-screen p-4 transition md:p-8 lg:mx-32">
            <div class="mb-8 grid grid-cols-1 gap-4 md:py-8 lg:grid-cols-5">
                {{-- Product detail --}}
                <div class="col-span-5 mb-8 md:col-span-2 md:flex md:gap-8 lg:block">
                    <div>
                        <a data-fslightbox="gallery" href="{{ asset('storage/uploads/products/' . $product->image) }}">
                            <img alt="{{ $product->name }}" class="relative mb-8 w-full rounded-lg object-cover md:h-80 md:w-80" loading="lazy" src="{{ asset('storage/uploads/products/' . $product->image) }}" />
                        </a>
                        <form action="#" method="post">
                            @csrf
                            @method('POST')
                            <button class="absolute right-2 top-2" type="submit">
                                @svg('tabler-heart', 'icon-md')
                            </button>
                        </form>
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
                        {!! $product->description !!}
                    </div>
                </div>

                {{-- attributes --}}
                <div class="col-span-5 md:col-span-3">
                    @foreach ($attributes as $attribute)
                        <div class="mb-8">
                            <p class="mb-4 font-normal">
                                <span class="text-red-500">*</span>
                                {{ $attribute->name }}
                            </p>
                            <div class="flex flex-wrap items-center gap-4 md:gap-8">
                                @foreach ($attribute->values as $value)
                                    <div class="min-w-32">
                                        <input checked class="peer hidden" id="option_{{ $value->id }}" name="attribute_{{ $attribute->id }}" required type="radio" value="{{ $value->value }}" />
                                        <label class="label-peer" for="option_{{ $value->id }}">
                                            <div class="text-sm font-normal">{{ $value->value }}</div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{-- toppings --}}
                    <div class="mb-8">
                        <p class="mb-4 font-normal">
                            Hương vị đậm đà hơn với topping tuỳ chỉnh
                        </p>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($toppings as $topping)
                                <div>
                                    <input class="peer hidden" id="{{ $topping->id }}" name="toppings" type="checkbox" value="{{ $topping->id }}">
                                    <label class="flex w-full cursor-pointer items-center justify-start gap-2 overflow-hidden rounded-lg border border-gray-200 bg-white p-2 text-gray-700 transition hover:bg-gray-50 hover:text-gray-600 peer-checked:border-red-600 peer-checked:text-red-600 md:gap-4" for="{{ $topping->id }}">
                                        <img alt="" class="h-16 w-16 flex-shrink-0 rounded-lg object-cover" loading="lazy" src="{{ asset('storage/uploads/toppings/' . $topping->image) }}">
                                        <div class="text-sm">
                                            <p class="mb-2 font-semibold">{{ $topping->name }}</p>
                                            <p>{{ number_format($topping->price) }} đ</p>
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
                                    <p class="mb-1 text-sm font-medium">{{ $evaluation->user->fullname }}</p>
                                    <p class="text-sm">{{ $evaluation->created_at }} | {{ $evaluation->product->name }}</p>
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
        <div class="sticky bottom-16 w-full border-t bg-white p-4 transition md:px-24 lg:bottom-0 lg:px-32">
            <div class="flex items-center justify-between">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button class="rounded-s-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500" type="button">
                        @svg('tabler-minus', 'icon-sm')
                    </button>
                    <div class="border-b border-t border-gray-200 bg-white px-4 py-1 text-sm font-medium text-gray-900">
                        1
                    </div>
                    <button class="rounded-e-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500" type="button">
                        @svg('tabler-plus', 'icon-sm')
                    </button>
                </div>

                <div class="flex items-center justify-center gap-4">
                    <p class="text-sm line-through">175,000đ</p>
                    <p class="text-lg font-semibold">143,000đ</p>
                </div>

                <div class="flex items-center justify-end gap-2">
                    <form action="{{ route('client.product.post-favorite', $product->slug) }}" method="post">
                        @method('POST')
                        @csrf
                        <button class="{{ $favorites->contains($product->id) ? 'button-red' : 'button-gray' }}" type="submit">
                            @svg('tabler-heart', 'md:me-2 icon-sm')
                            <span class="hidden md:block">
                                {{ $favorites->contains($product->id) ? 'Đã yêu thích' : 'Yêu thích' }}
                            </span>
                        </button>
                    </form>

                    <button class="button-red">
                        @svg('tabler-shopping-bag-plus', 'md:me-2 icon-sm')
                        <span class="hidden md:block">Thêm vào giỏ hàng</span>
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection

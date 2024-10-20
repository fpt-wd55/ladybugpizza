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
                <div class="card p-4 md:p-8 col-span-5">
                    <p class="title">Đánh giá sản phẩm</p>
                    {{-- info --}}
                    <div class="mb-4 flex items-center gap-4">
                        <img alt="" class="img-circle img-sm" loading="lazy" src="{{ Auth::user()->avatar() }}">
                        <div>
                            <p class="mb-1 text-sm font-medium">Đỗ Hồng Quân</p>
                            <p class="text-sm">25-07-2024 20:06 | Đế mỏng; Size S; Topping: Thịt bò, Hành tây</p>
                        </div>
                    </div>
                    {{-- content --}}
                    <div class="mb-4 px-8">
                        <p class="mb-4 text-sm">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates ducimus sint porro facere iure placeat magnam? A aliquid odio vel quo atque sequi, architecto voluptatum expedita facilis accusantium nulla consectetur earum accusamus officiis facere modi nam ea dicta!
                            Magnam ducimus eaque similique a totam culpa, quam eos optio ab debitis numquam praesentium laudantium cum aperiam doloremque. Voluptatibus quo placeat cum velit voluptas! Dolore nam est aliquid maiores voluptatem optio corrupti cumque? Nobis molestiae illo dignissimos rerum est ullam tempora fuga pariatur tempore odit sunt quas excepturi aliquid eos, reprehenderit, velit commodi culpa harum nihil minus? Quibusdam enim at error saepe.</p>
                        <div class="flex w-full items-center gap-4 overflow-hidden">
                            @for ($i = 0; $i < 4; $i++)
                                <img alt="" class="img-md rounded-lg" loading="lazy" src="{{ asset('storage/uploads/products/tiramisu.jpeg') }}">
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Evaluation --}}
        <div class="card p-4 md:p-8">
            <p class="title">Đánh giá sản phẩm</p>
            @foreach ($evaluations as $evaluation)
                <div class="mb-4">
                    {{-- info --}}

                    <div class="mb-4 flex items-center gap-4">
                        <img alt="" class="img-circle img-sm" loading="lazy"
                            src="{{ filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL) ? Auth::user()->avatar : asset('storage/uploads/avatars/' . (Auth::user()->avatar ?? 'user-default.png')) }}">
                        <div>
                            <p class="mb-1 text-sm font-medium">{{ $evaluation->user->fullname }}</p>
                            <p class="text-sm">{{ $evaluation->created_at }} | {{ $evaluation->product->name }}</p>
                        </div>
                    </div>
                    {{-- content --}}
                    <div class="mb-4 px-8">
                        <p class="mb-4 text-sm">{{ $evaluation->comment }}</p>
                        <div class="flex w-full items-center gap-4 overflow-hidden">
                            @for ($i = 0; $i < 4; $i++)
                                <a data-fslightbox="gallery" href="{{ asset('storage/uploads/products/cake/chocolate_tar.jpeg') }}">
                                    <img class="img-md rounded-lg" loading="lazy" src="{{ asset('storage/uploads/products/cake/chocolate_tar.jpeg') }}">
                                </a>
                            @endfor
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

    {{-- Add to card bar --}}
    <div class="sticky bottom-16 w-full border-t bg-white p-4 transition md:px-24 lg:bottom-0 lg:px-32">
        <div class="flex items-center justify-between">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button
                    class="rounded-s-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500"
                    type="button">
                    @svg('tabler-minus', 'icon-sm')
                </button>
                <div class="border-b border-t border-gray-200 bg-white px-4 py-1 text-sm font-medium text-gray-900">
                    1
                </div>
                <button
                    class="rounded-e-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500"
                    type="button">
                    @svg('tabler-plus', 'icon-sm')
                </button>
            </div>

            <div class="flex items-center justify-center gap-4">
                <p class="line-through text-sm">175,000đ</p>
                <p class="font-semibold text-lg">143,000đ</p>
            </div>

            <div class="flex items-center justify-end gap-2">
                <button class="button-gray">
                    @svg('tabler-heart', 'md:me-2 icon-sm')
                    <span class="hidden md:block">Yêu thích</span>
                </button>
                <button class="button-red">
                    @svg('tabler-shopping-bag-plus', 'md:me-2 icon-sm')
                    <span class="hidden md:block">Thêm vào giỏ hàng</span>
                </button>
            </div>
        </div>
    </form>

@endsection

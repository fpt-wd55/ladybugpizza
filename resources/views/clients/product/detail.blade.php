@extends('layouts.client')

@section('title', 'Chi tiết sản phẩm')

@section('content')

    <div class="lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="card p-4 md:p-8 grid grid-cols-1 lg:grid-cols-5 gap-4 mb-8">

            {{-- Product detail --}}
            <div class="col-span-5 md:col-span-2 md:flex md:gap-8 lg:block mb-8">
                <div>
                    <img loading="lazy" src="{{ asset('storage/uploads/products/' . $product->category->slug . '/' . $product->image) }}" alt="{{ $product->name }}" class=" relative w-full md:w-80 md:h-80 object-cover rounded-lg mb-8" />
                    <form action="#" method="post">
                        @csrf
                        @method('POST')
                        <button class="absolute top-2 right-2" type="submit">
                            @svg('tabler-heart', 'icon-md')
                        </button>
                    </form>
                </div>
                <div>
                    <p class="text-xl md:text-2xl uppercase mb-4 font-medium">{{ $product->name }}</p>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="flex items-center gap-1">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $product->avg_rating)
                                    @svg('tabler-star-filled', 'icon-md text-red-500')
                                @else
                                    @svg('tabler-star', 'icon-md text-red-500')
                                @endif
                            @endfor
                        </div>
                        <p>({{ $product->avg_rating }})</p>
                    </div>
                    <p class="">{{ $product->description }}</p>
                </div>
            </div>

            {{-- attributes --}}
            <div class="col-span-5 md:col-span-3">
                <div class="mb-8">
                    <p class="font-normal mb-4">
                        <span class="text-red-500">*</span>
                        Đế bánh
                    </p>
                    <div class="flex items-center justify-between gap-8">
                        <div class="w-full">
                            <input type="radio" id="hand_tossed" name="pizza_base" value="hand_tossed" class="hidden peer" checked required />
                            <label for="hand_tossed" class="label-peer">
                                <div class="text-sm font-normal">Đế dày</div>
                            </label>
                        </div>
                        <div class="w-full">
                            <input type="radio" id="thin_crust" name="pizza_base" value="thin_crust" class="hidden peer">
                            <label for="thin_crust" class="label-peer">
                                <div class="text-sm font-normal">Đế mỏng</div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="font-normal mb-4">
                        <span class="text-red-500">*</span>
                        Kích cỡ
                    </p>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="w-full">
                            <input type="radio" id="s" name="size" value="s" class="hidden peer" checked required />
                            <label for="s" class="label-peer">
                                <div class="text-sm text-center">
                                    <p class="font-semibold mb-2">Size S (20cm)</p>
                                    <p class="text-sm">Phù hợp cho 1 - 2 người</p>
                                </div>
                            </label>
                        </div>
                        <div class="w-full">
                            <input type="radio" id="m" name="size" value="m" class="hidden peer" />
                            <label for="m" class="label-peer">
                                <div class="text-sm text-center">
                                    <p class="font-semibold mb-2">Size M (28cm)</p>
                                    <p class="text-sm">Phù hợp cho 2 - 3 người</p>
                                </div>
                            </label>
                        </div>
                        <div class="w-full">
                            <input type="radio" id="l" name="size" value="l" class="hidden peer" />
                            <label for="l" class="label-peer">
                                <div class="text-sm text-center">
                                    <p class="font-semibold mb-2">Size L (35cm)</p>
                                    <p class="text-sm">Phù hợp cho 3 - 5 người</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- toppings --}}
                <div class="mb-8">
                    <p class="font-normal mb-4">
                        Bổ sung topping
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($toppings as $topping)
                            <div>
                                <input type="checkbox" name="toppings" value="{{ $topping->id }}" id="{{ $topping->id }}" class="peer hidden">
                                <label for="{{ $topping->id }}" class="w-full text-gray-700 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-red-600 peer-checked:text-red-600 hover:text-gray-600 hover:bg-gray-50 transition p-2 flex justify-start gap-2 md:gap-4 items-center overflow-hidden">
                                    <img loading="lazy" src="{{ asset('storage/uploads/toppings/' . $topping->image) }}" class="flex-shrink-0 w-16 h-16 object-cover rounded-lg" alt="">
                                    <div class="text-sm">
                                        <p class="font-semibold mb-2 ">{{ $topping->name }}</p>
                                        <p>{{ number_format($topping->price) }} đ</p>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        {{-- Evaluation --}}
        <div class="card p-4 md:p-8">
            <p class="title">Đánh giá sản phẩm</p>

            <div class="mb-4">
                {{-- info --}}
                <div class="flex items-center gap-4 mb-4">
                    <img loading="lazy" src="{{ asset('storage/uploads/avatars/user-default.png') }}" class="img-circle img-sm" alt="">
                    <div>
                        <p class="mb-1 text-sm font-medium">Đỗ Hồng Quân</p>
                        <p class="text-sm">25-07-2024 20:06 | Đế mỏng; Size S; Topping: Thịt bò, Hành tây</p>
                    </div>
                </div>
                {{-- content --}}
                <div class="mb-4 px-8">
                    <p class="text-sm mb-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates ducimus
                        sint porro facere iure placeat magnam? A aliquid odio vel quo atque sequi, architecto voluptatum
                        expedita facilis accusantium nulla consectetur earum accusamus officiis facere modi nam ea
                        dicta!
                        Magnam ducimus eaque similique a totam culpa, quam eos optio ab debitis numquam praesentium
                        laudantium cum aperiam doloremque. Voluptatibus quo placeat cum velit voluptas! Dolore nam est
                        aliquid maiores voluptatem optio corrupti cumque? Nobis molestiae illo dignissimos rerum est
                        ullam
                        tempora fuga pariatur tempore odit sunt quas excepturi aliquid eos, reprehenderit, velit commodi
                        culpa harum nihil minus? Quibusdam enim at error saepe.</p>
                    <div class="flex items-center gap-4 w-full overflow-hidden">
                        @for ($i = 0; $i < 4; $i++)
                            <img loading="lazy" src="{{ asset('storage/uploads/products/cake/chocolate_tar.jpeg') }}" class="rounded-lg img-md" alt="">
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add to card bar --}}
    <div class="border-t sticky bottom-0 w-full bg-white transition md:px-24 lg:px-32 p-4">
        <div class="flex items-center justify-between">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button type="button" class="px-2 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-red-500">
                    @svg('tabler-minus', 'icon-sm')
                </button>
                <div class="px-4 py-1.5 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200">
                    1
                </div>
                <button type="button" class="px-2 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-red-500">
                    @svg('tabler-plus', 'icon-sm')
                </button>
            </div>

            <p class="font-semibold text-lg">100,000đ</p>

            <button class="button-red">
                @svg('tabler-shopping-bag-plus', 'md:me-2 icon-md')
                <span class="hidden md:block">Thêm vào giỏ hàng</span>
            </button>
        </div>
    </div>
@endsection

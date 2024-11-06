@extends('layouts.client')

@section('title', 'Chi tiết combo')

@section('content')
    <form action="}" method="post">
        @method('POST')
        @csrf
        <div class="min-h-screen p-4 transition md:p-4 lg:mx-32">

            {{-- Product detail --}}
            <div class="no-scrollbar flex w-full items-center gap-4 overflow-x-auto">

                <a class="product-card relative flex w-full flex-shrink-0 overflow-hidden " href="">
                    <img alt="" class="h-60 w-1/2 flex-shrink-0 object-cover" loading="lazy"
                        src="{{ asset('storage/uploads/products/an-het-menu-khong-lo-map-u.jpeg') }}">
                    <div class="p-4">
                        <p class="mb-2 text-sm font-semibold md:text-base">Combo ăn thả ga</p>
                        <ul class="list-disc space-y-1 ps-4 text-xs md:text-sm">
                            <li>Pizza xúc xích phô mai size S</li>
                            <li>Pizza xúc xích phô mai size M</li>
                            <li>2 Pepsi lon 450ml</li>
                        </ul>
                        <div class="absolute bottom-4 flex items-center gap-2">
                            <p class="text-sm text-gray-500 line-through">190,000₫</p>
                            <p class="text-lg font-semibold">190,000₫</p>
                        </div>
                    </div>
                </a>

            </div>

            <div class="mt-10">
                <p class="inline-block uppercase rounded-t-lg mb-3 pb-1 border-b-2 border-[#D30A0A] text-[#D30A0A]">chi tiết
                    combo</p>
                <div class="grid grid-cols-2 gap-2">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="product-card flex h-[100px] bg-white shadow-md rounded-lg overflow-hidden">
                            <img alt="Bánh mì ăn liền" class="w-1/3 h-full object-cover" loading="lazy"
                                src="{{ asset('storage/uploads/products/pasta-carbonara.jpeg') }}">
                            <div class="p-2 flex-grow text-sm">
                                <p class="md:mb-1 font-semibold">Pizza carbonara</p>
                                <p class="line-clamp-2">ngon đậm vị</p>
                                <span class="float-right mr-4 md:pt-4 text-[#D30A0A] font-medium">x2</span>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            {{-- Evaluation --}}
            <div class="card col-span-5 p-4 md:p-8 mt-5">
                <p class="title">Đánh giá sản phẩm</p>
                @for ($i = 0; $i < 5; $i++)
                    <div class="mb-12">
                        {{-- info --}}
                        <div class="mb-4 flex items-center gap-4">
                            <img alt="" class="img-circle img-sm" loading="lazy"
                                src="{{ asset('storage/uploads/avatars/8BtecQvUAuNBKKyyvpVPmgBHePejYpJfg3xsaNKN.webp') }}">
                            <div>
                                <div class="mb-1 flex items-center gap-2">
                                    <p class="text-sm font-medium">Đỗ Hồng Quân</p>
                                    <div class="flex items-center gap-1">
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star', 'icon-sm text-red-500')
                                    </div>
                                </div>
                                <p class="text-sm">12:30:00</p>
                            </div>
                        </div>
                        {{-- content --}}
                        <div class="mb-4 px-14">
                            <p class="mb-4 text-sm">Combo này quá rẻ</p>
                            <div class="no-scrollbar flex w-full items-center gap-4 overflow-x-auto">
                                @for ($i = 0; $i < 5; $i++)
                                    <a class="min-w-16 min-h-16 max-w-16 max-h-16 overflow-hidden" data-fslightbox="gallery"
                                        href="{{ asset('storage/uploads/products/tiramisu.jpeg') }}">
                                        <img class="w-full rounded object-cover" loading="lazy"
                                            src="{{ asset('storage/uploads/products/tiramisu.jpeg') }}">
                                    </a>
                                @endfor
                            </div>
                        </div>
                        <hr>
                    </div>
                @endfor

            </div>
        </div>


        </div>

        {{-- Add to card bar --}}
        <div class="sticky bottom-16 w-full border-t bg-white p-4 transition lg:bottom-0 lg:px-32">
            <div class="flex items-center justify-between">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button
                        class="rounded-s-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500"
                        id="decrement" type="button">
                        @svg('tabler-minus', 'icon-sm')
                    </button>
                    <input
                        class="w-12 border-b border-t border-gray-200 bg-white px-4 py-1 text-center text-sm font-medium text-gray-900 focus:outline-none"
                        name="quantity" value="1">
                    <button
                        class="rounded-e-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500"
                        id="increment" type="button">
                        @svg('tabler-plus', 'icon-sm')
                    </button>
                </div>

                <div class="flex items-center justify-center gap-4">
                    <p class="text-sm line-through">175,000đ</p>
                    <p class="text-lg font-semibold">143,000đ</p>
                </div>

                <div class="flex items-center justify-end gap-2">
                    <a class="" href="{" type="submit">
                        @svg('tabler-heart', 'md:me-2 icon-sm')
                        <span class="hidden md:block">

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


@endsection

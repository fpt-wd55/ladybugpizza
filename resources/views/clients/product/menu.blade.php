@extends('layouts.client')
@section('content')
    <div class="flex md:flex-row flex-col justify-center mx-auto px-auto mt-10">
        <div
            class="flex flex-col md:w-[220px] lg:w-[285px] lg:h-[780px] md:h-[780px] lg:p-4 md:p-0 overflow-y-auto card my-15 bg-white  lg:mx-5 md:mx-0">
            </h2>
            <h2 class="text-xl font-bold mb-4 md-[20px]"><i class="fas fa-filter"></i>Bộ lọc</h2>

            <div class="mb-4 ">
                <input type="text" placeholder="Tìm kiếm..." class="border border-gray-300 rounded p-2 w-full" />
                <button class="button-red text-white rounded px-4 py-2 w-full mt-5 hover:bg-red-600">Tìm kiếm</button>
            </div>
            <div class="mb-4 md:flex md:items-start">
                <div class="md:flex-1">
                    <h3 class="font-semibold mb-2">Danh mục</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> Pizza
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> Mỳ Ý
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> Salat
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> Đồ uống
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> Gà rán
                        </label>
                    </div>
                </div>
            </div>

            <hr class="border-t-2 border-gray-300 w-full my-2" />
            <div class="mb-4 ">
                <h3 class="font-semibold mb-2">Đánh giá</h3>
                <div>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> 5 sao
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> Từ 4 sao
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> Từ 3 sao
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> Từ 2 sao
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="input-checkbox mr-2" /> Từ 1 sao
                        </label>
                    </div>
                </div>
            </div>

            <hr class="border-t-2 border-gray-300 w-full my-2" />

            <div class="mb-4">
                <h3 class="font-semibold mb-2">Giá</h3>
                <div class="flex items-center ">
                    <button class="border border-gray-200 text-gray-500 bg-white rounded py-2 w-1/3 hover:bg-gray-100">Tối
                        thiểu</button>
                    <hr class="border-l border-gray-400 flex-grow mx-2 ml-3" />
                    <button
                        class="border border-gray-200 text-gray-500 bg-white rounded px-2 py-2 w-1/3 hover:bg-gray-100">Tối
                        đa</button>
                </div>

            </div>
            <button class="text-white rounded px-4 py-2 mt-4 w-full button-red ">Áp dụng</button>
        </div>
        <div class="menu md:w-[460px] md:ml-5 lg:w-[603px] lg:ml-1 md:ml-0 lg:h-[1300px] md:h-[]">
            <div class="hidden md:block">
                <a href="#">
                    <p class="font-bold ">Combo</p>
                    <div
                        class="flex  md:w-[460px] md:h-[140px] lg:h-[190px] lg:w-[595px] border rounded-lg overflow-hidden ">
                        <div class="flex-shrink-0 md:h-[140px] md:w-[230px] lg:w-[300px] lg:h-[190px]">
                            <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" class="h-full w-auto object-cover"
                                alt="">
                        </div>
                        <div class="flex-grow pl-2 p-2 lg:ml-2 font-bold">
                            <p class="label-md lg:mt-2 md:mt-0">Combo 2 Pizza + Pepsi - Ăn gà thả ga - Giá siêu rẻ</p>
                            <div class="text-xs font-normal px-2 pl-2 leading-5">
                                <li> Pizza xúc xích phô mai sz M</li>
                                <li> Pizza xúc xích phô mai sz S</li>
                                <li> 2 Pepsi 450ml lon</li>
                            </div>
                            <div class="lg:mt-9 md:mt-0">
                                <span class="text-xs font-normal line-through text-[#9B9B9B]">190,000đ</span>
                                <span class="font-medium">130,000đ</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div
                        class="flex  md:w-[460px] md:h-[140px] lg:h-[190px] lg:w-[595px] border rounded-lg overflow-hidden mt-4">
                        <div class="flex-shrink-0 md:h-[140px] md:w-[230px] lg:w-[300px] lg:h-[190px]">
                            <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" class="h-full w-auto object-cover"
                                alt="">
                        </div>
                        <div class="flex-grow pl-2 p-2 lg:ml-2 font-bold">
                            <p class="label-md lg:mt-2 md:0">Combo 2 Pizza + Pepsi - Ăn gà thả ga - Giá siêu rẻ</p>
                            <div class="text-xs font-normal px-2 pl-2 leading-5">
                                <li> Pizza xúc xích phô mai sz M</li>
                                <li> Pizza xúc xích phô mai sz S</li>
                                <li> 2 Pepsi 450ml lon</li>
                            </div>
                            <div class="lg:mt-9 md:mt-0">
                                <span class="text-xs font-normal line-through text-[#9B9B9B]">190,000đ</span>
                                <span class="font-medium">130,000đ</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="lg:w-[600px] mt-3">
                <p class="font-bold ">Pizza</p>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-1 mt-3 md:gap-5 md:justify-center">
                    @for ($i = 0; $i < 6; $i++)
                        <a href="#" class="">
                            <div
                                class="md:flex w-[160px] h-[320px] md:h-[135px] lg:w-[285px] lg:h-[126px] mx-auto border rounded-lg overflow-hidden">
                                <div class="flex-shrink-0 md:w-[60px] w-[160px] h-[160px] ">
                                    <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}"
                                        class="h-full w-auto object-cover" alt="">
                                </div>
                                <div class="flex-grow pl-2 p-2 font-bold">
                                    <p class="label-md mt-1">Taramisu V</p>
                                    <div class="flex">
                                        <p class=" underline md:pr-1 pr-0 label-sm">4.5</p>
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-half-filled', 'icon-sm text-red-500')
                                        <p class="label-sm">(15)</p>
                                    </div>
                                    <div class="">
                                        <p class="text-xs font-normal">Traditional Italian tiramisu infus with rum &
                                            coffee</p>
                                    </div>
                                    <div class="">
                                        <span class="text-xs font-normal line-through text-[#9B9B9B]">190,000đ</span>
                                        <span class="font-normal">130,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endfor
                </div>
            </div>

            <div class="lg:w-[600px] mt-3">
                <p class="font-bold">Bánh ngọt</p>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-1 mt-3 md:gap-5 md:justify-center">
                    @for ($i = 0; $i < 6; $i++)
                        <a href="#" class="">
                            <div
                                class="md:flex w-[160px] h-[320px] md:h-[135px] lg:w-[285px] lg:h-[126px] mx-auto border rounded-lg overflow-hidden">
                                <div class="flex-shrink-0 md:w-[60px] w-[160px] h-[160px]">
                                    <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}"
                                        class="h-full w-auto object-cover" alt="">
                                </div>
                                <div class="flex-grow pl-2 p-2 font-bold">
                                    <p class="label-md mt-1">Taramisu V</p>
                                    <div class="flex">
                                        <p class=" underline md:pr-1 pr-0 label-sm">4.5</p>
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                        @svg('tabler-star-half-filled', 'icon-sm text-red-500')
                                        <p class="label-sm">(15)</p>
                                    </div>
                                    <div class="">
                                        <p class="text-xs font-normal">Traditional Italian tiramisu infus with rum &
                                            coffee</p>
                                    </div>
                                    <div class="">
                                        <span class="text-xs font-normal line-through text-[#9B9B9B]">190,000đ</span>
                                        <span class="font-normal">130,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection

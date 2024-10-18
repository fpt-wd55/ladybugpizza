@extends('layouts.admin')
@section('title', 'Đánh Giá | Chi Tiết')
@section('content')
    {{ Breadcrumbs::render('admin.products.show', $sanpham) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <div>

                {{-- end điểm hội viên --}}
                <div class="py-4 md:py-5 px-3">
                    <a class="product-card overflow-hidden md:flex" href="">
                        <img alt="" class="h-48 w-auto flex-shrink-0 object-cover  md:w-1/3" loading="lazy" src="{{ asset('storage/uploads/products/' . $sanpham->image) }}">
                        <div class="p-2 ml-3 text-sm">
                            <p class="mb-2  font-semibold text-2xl">{{$sanpham->name}}</p>
                            <div class="mb-2 flex items-center text-lg gap-1">
                                <p>{{ $sanpham->avg_rating }}</p>
                                <div class="flex items-center gap-1">
                                    @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $sanpham->avg_rating)
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                    @else
                                        @svg('tabler-star', 'icon-sm text-red-500')
                                    @endif
                                @endfor
                                </div>
                                <p>({{ $sanpham->total_rating }})</p>
                            </div>
                            <p class="mb-4 line-clamp-3 h-12 text-base">{{ $sanpham->description }}</p>
                            <div class="bottom-4 flex items-center gap-3">
                                <p class="text-sm text-gray-500 line-through">{{ number_format($sanpham->price) }}đ</p>
                                <p class="font-semibold text-base">{{ number_format($sanpham->discount_price) }}đ</p>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- lịch sử tiêu dùng của khách hàng --}}
                <hr>
                <div class="lg:flex">
                    <div class=" p-4 md:p-8 w-full min-h-screen">
                        <h3 class="font-semibold text-lg uppercase mb-8">Lịch Sử Đánh Giá</h3>
                                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                    <div class="card p-4 mb-4">
                                        {{-- info --}}
                                        <div class="mb-4 flex items-center gap-4">
                                            <img alt="" class="mb-3 img-circle img-sm" loading="lazy" src="{{ filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL) ? Auth::user()->avatar : asset('storage/uploads/avatars/' . (Auth::user()->avatar ?? 'user-default.png')) }}">
                                            <div class="">
                                                <p class="mb-1 text-sm font-medium" >Đỗ Hồng Quân</p>
                                                <div class="flex items-center gap-0.5 ">                                                  
                                                            @svg('tabler-star-filled', 'icon-sm text-red-500')
                                                            @svg('tabler-star-filled', 'icon-sm text-red-500')
                                                            @svg('tabler-star-filled', 'icon-sm text-red-500')
                                                            @svg('tabler-star-filled', 'icon-sm text-red-500')
                                                </div>
                                                <p class="text-sm">25-07-2024 20:06 | Đế mỏng; Size S; Topping: Thịt bò, Hành tây</p>
                                            </div>
                                            <div class="ml-auto self-start">
                                                <div class="flex items-center">
                                                    <div
                                                        class="inline-block indicator bg-green-700">
                                                    </div>
                                                    Hiển thị

                                                    <div class="px-1 py-3 flex items-center float-right">
                                                        <button id="-dropdown-button"
                                                            data-dropdown-toggle="-dropdown"
                                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none pt-1"
                                                            type="button">
                                                            @svg('tabler-dots-vertical', 'w-5 h-5')
                                                        </button>
                                                        <div id="-dropdown"
                                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                                            <ul class="py-1 text-sm text-gray-700"
                                                                aria-labelledby="-dropdown-button">
                              
                                                                <li>
                                                                    <a href=""
                                                                        class="block py-2 px-4 hover:bg-gray-100">Chi Tiết Hóa Đơn</a>
                                                                </li>

                                                                <li class="block py-2 px-4 hover:bg-gray-100">
                                                                    <div class="flex gap-x-2 items-center">
                                                                    <p class="">Trạng Thái</p>
                                                                        <form action=""method="POST" class="mt-1">
                                                                            @csrf
                                                                            <label for="status-toggle" class="inline-flex relative items-center cursor-pointer">
                                                                                <input type="checkbox" id="status-toggle" name="status" class="sr-only peer"
                                                                                    value="1" 
                                                                                    onchange="">
                                                                                <div
                                                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none  rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                                                </div>
                                                                            </label>
                                                                        </form>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- content --}}
                                        <div class="mb-4 px-8">
                                            <p class="mb-4 text-sm">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates ducimus
                                                sint porro facere iure placeat magnam? A aliquid odio vel quo atque sequi, architecto voluptatum
                                                expedita facilis accusantium nulla consectetur earum accusamus officiis facere modi nam ea
                                                dicta!
                                                Magnam ducimus eaque similique a totam culpa, quam eos optio ab debitis numquam praesentium
                                                laudantium cum aperiam doloremque. Voluptatibus quo placeat cum velit voluptas! Dolore nam est
                                                aliquid maiores voluptatem optio corrupti cumque? Nobis molestiae illo dignissimos rerum est
                                                ullam
                                                tempora fuga pariatur tempore odit sunt quas excepturi aliquid eos, reprehenderit, velit commodi
                                                culpa harum nihil minus? Quibusdam enim at error saepe.</p>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end lịch sử tiêu dùng của khách hàng --}}
                        </div>
                    </div>
                </div>

@endsection

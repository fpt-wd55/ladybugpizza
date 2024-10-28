@extends('layouts.client')


@section('title', 'Trang chủ')

@section('content')
    <div class="mx-auto px-0">
        <div class="relative flex min-h-[calc(100vh-48px)] flex-col-reverse items-center justify-center gap-16 overflow-hidden bg-gray-100 p-8 transition md:px-32 lg:flex-row lg:justify-between lg:px-40">
            <div class="z-10 text-center lg:text-left">
                <p class="vujahday-script-regular mb-8 text-6xl">Ladybug Pizza</p>
                <p class="playwrite-gb-s-regular mb-12 text-sm uppercase text-gray-500">Thưởng thức pizza ngon lành bổ dưỡng của bạn</p>
                <a class="button-primary" href="{{ route('client.product.menu') }}">Thực đơn</a>
            </div>
            <div class="z-10 w-60 flex-shrink-0 transition md:w-[400px] lg:w-[520px]">
                <img alt="" class="w-full transition-transform duration-500 hover:rotate-[90deg] hover:transform" src="https://static.vecteezy.com/system/resources/previews/024/589/160/non_2x/top-view-pizza-with-ai-generated-free-png.png">
            </div>

            <div class="absolute left-[-80px] top-[-200px] h-96 w-96 rounded-full bg-white"></div>
            <div class="absolute bottom-[-400px] right-[-400px] h-[800px] w-[800px] rounded-full bg-white"></div>
        </div>


        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">

            <div>
                {{-- carousel --}}
                <!-- <div class="relative mb-8 w-full md:mb-12" data-carousel="slide" id="default-carousel">
                                                <div class="relative h-56 overflow-hidden rounded transition md:h-96 lg:h-[540px]">
                                                    @foreach ($banners as $banner)
    <link as="image" href="{{ asset('storage/uploads/banners/' . $banner->image) }}" rel="preload">
                                                        <div class="hidden transition duration-700" data-carousel-item>
                                                            <img alt="{{ $banner->image }}" class="absolute block h-full w-full object-cover" src="{{ asset('storage/uploads/banners/' . $banner->image) }}">
                                                        </div>
    @endforeach
                                                </div>
                                                <div class="absolute bottom-5 left-1/2 z-30 flex -translate-x-1/2">
                                                    @foreach ($banners as $index => $banner)
    <button aria-current="true" class="indicator" data-carousel-slide-to="{{ $index }}" type="button"></button>
    @endforeach
                                                </div>
                                                <button class="group absolute start-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none" data-carousel-prev type="button">
                                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 text-white">
                                                        @svg('tabler-chevron-left', 'icon-sm')
                                                    </span>
                                                </button>
                                                <button class="group absolute end-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none" data-carousel-next type="button">
                                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 text-white">
                                                        @svg('tabler-chevron-right', 'icon-sm')
                                                    </span>
                                                </button>
                                            </div> -->

                <div class="mt-12 py-8 text-center">
                    <p class="vujahday-script-regular mb-6 text-center text-6xl">Ladybug Pizza</p>
                    <p class="playwrite-gb-s-regular mb-12 text-sm uppercase text-gray-500">Ngon đến từng miếng, đậm vị yêu thương</p>
                    @include('partials.clients.categories')
                </div>


                {{-- hot pizza --}}
                <div class="mb-32">
                    <div class="mb-8 flex items-start justify-between">
                        <p class="text-lg font-semibold uppercase">Sản Phẩm Nổi Bật</p>
                    </div>
                    <div class="mb-16 grid grid-cols-2 gap-4 lg:grid-cols-3">
                        @foreach ($products as $product)
                            <a class="product-card overflow-hidden md:flex" href="{{ route('client.product.show', $product->slug) }}">
                                <img alt="" class="h-48 w-full flex-shrink-0 object-cover md:h-full md:w-1/3" loading="lazy" src="{{ asset('storage/uploads/products/' . $product->image) }}">
                                <div class="p-2 text-sm">
                                    <p class="mb-2 font-semibold">{{ $product->name }}</p>
                                    <div class="mb-2 flex items-center gap-1">
                                        <p>{{ $product->avg_rating }}</p>
                                        <div class="flex items-center gap-1">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $product->avg_rating)
                                                    @svg('tabler-star-filled', 'icon-sm text-red-600')
                                                @else
                                                    @svg('tabler-star', 'icon-sm text-red-600')
                                                @endif
                                            @endfor
                                        </div>
                                        <p>({{ $product->total_rating }})</p>
                                    </div>
                                    <p class="{{ empty($product->description) ? 'min-h-12' : '' }} mb-4 line-clamp-2">{{ $product->description }}</p>
                                    <div class="bottom-4 flex items-center gap-3">
                                        <p class="text-xs text-gray-500 line-through">{{ number_format($product->price) }}₫</p>
                                        <p class="font-semibold">{{ number_format($product->discount_price) }}₫</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <a class="button-primary" href="{{ route('client.product.menu') }}">Xem tất cả</a>
                    </div>

                </div>

                <p class="vujahday-script-regular mb-32 text-center text-6xl">Khám phá</p>

                {{-- Khám phá thực đơn --}}
                <div class="mb-32 grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="mr-3 flex flex-col items-center text-center">
                        <p class="playwrite-gb-s-regular mb-6 text-lg uppercase">Thực đơn của chúng tôi</p>

                        <p class="mb-8 font-light">
                            Khám phá các loại Pizza nướng bằng củi, bia Bỉ và các món tráng miệng mới làm mà bạn có
                            thể thưởng thức tại 2 địa điểm của chúng tôi hoặc tại nhà với dịch vụ giao hàng nhanh chóng của
                            chúng tôi.
                        </p>
                        <a class="button-primary mb-8" href="{{ route('client.product.menu') }}">Đặt ngay</a>
                        <div class="font-light">
                            <p class="font-normal">Dịch vụ bữa trưa</p>
                            <p class="mb-4">Từ 11am đến 3pm </p>
                            <p class="font-normal">Dịch vụ bữa tối</p>
                            <p class="mb-4">Từ 5pm đến 10pm</p>
                            <p class="mb-8">Xin lưu ý rằng gọi món lần cuối là 30 phút trước giờ đóng cửa</p>
                        </div>
                    </div>

                    <img alt="" class="h-full w-full flex-shrink-0 rounded-lg object-cover" loading="lazy" src="{{ asset('storage/uploads/products/pizza-5-cheese.jpeg') }}">
                </div>

                {{-- Cau chuyen cua chung toi --}}
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="grid grid-cols-2 grid-rows-2 gap-4">
                        <img alt="" class="h-full w-full rounded-lg object-cover" loading="lazy" src="{{ asset('storage/uploads/products/pizza-margherita.jpeg') }}">
                        <img alt="" class="h-full w-full rounded-lg object-cover" loading="lazy" src="{{ asset('storage/uploads/products/pizza-4-cheese.jpeg') }}">
                        <img alt="" class="h-full w-full rounded-lg object-cover" loading="lazy" src="{{ asset('storage/uploads/products/pizza-burrata-cay.jpeg') }}">
                        <img alt="" class="h-full w-full rounded-lg object-cover" loading="lazy" src="{{ asset('storage/uploads/products/pizza-ca-hoi.jpg') }}">
                    </div>
                    <div class="text-center">
                        <p class="playwrite-gb-s-regular mb-6 text-lg uppercase">Câu chuyện của chúng tôi</p>
                        <p class="mb-6 font-light lg:mb-8">Khám phá các loại Pizza nướng bằng củi, bia Bỉ và các món tráng
                            miệng mới làm mà bạn có thể thưởng thức tại 2 địa điểm của chúng tôi hoặc tại nhà với dịch vụ giao
                            hàng nhanh chóng của chúng tôi.
                        </p>
                        <p class="mb-8 font-light">Ladybug Pizza là một tiệm bánh Pizza đích thực, nằm ở trung tâm Hà Nội. Những chiếc
                            bánh pizza của chúng tôi được nướng trong lò đốt củi và phủ bên trên những nguyên liệu tươi, tự
                            nhiên và được lựa chọn cẩn thận.
                        </p>
                        <p class="mb-4 flex items-center justify-center">
                            <a class="button-primary" href="{{ route('client.about-us') }}">Về chúng tôi</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

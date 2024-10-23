@extends('layouts.client')


@section('title', 'Trang chủ')

@section('content')
    <div class="mx-auto px-0">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">

            <div>
                {{-- carousel --}}
                <div class="relative mb-8 w-full md:mb-12" data-carousel="slide" id="default-carousel">
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
                </div>

                <div class="mt-12 py-8 text-center">
                    <p class="vujahday-script-regular mb-6 text-center text-6xl">Ladybug Pizza</p>
                    <p class="mb-12 uppercase text-gray-500">Ngon đến từng miếng, đậm vị yêu thương</p>
                    @include('partials.clients.categories')
                </div>


                {{-- hot pizza --}}
                <div class="mb-32">
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-lg font-semibold uppercase">Sản Phẩm Nổi Bật</p>
                        <a class="link-lg" href="{{ route('client.product.menu') }}">Xem thêm</a>
                    </div>
                    <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
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
                                                    @svg('tabler-star-filled', 'icon-sm text-red-500')
                                                @else
                                                    @svg('tabler-star', 'icon-sm text-red-500')
                                                @endif
                                            @endfor
                                        </div>
                                        <p>({{ $product->total_rating }})</p>
                                    </div>
                                    <p class="mb-4 line-clamp-3 h-12">{{ $product->description }}</p>
                                    <div class="bottom-4 flex items-center gap-3">
                                        <p class="text-xs text-gray-500 line-through">{{ number_format($product->price) }}đ</p>
                                        <p class="font-semibold">{{ number_format($product->discount_price) }}đ</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <p class="vujahday-script-regular mb-32 text-center text-6xl">Khám phá</p>

                {{-- Khám phá thực đơn --}}
                <div class="mb-32 grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="mr-3 flex flex-col items-center text-center">
                        <p class="vujahday-script-regular mb-6 text-3xl lg:text-4xl">
                            Thực đơn của chúng tôi</p>

                        <p class="mb-8 font-light">
                            Khám phá các loại Pizza nướng bằng củi, bia Bỉ và các món tráng miệng mới làm mà bạn có
                            thể thưởng thức tại 2 địa điểm của chúng tôi hoặc tại nhà với dịch vụ giao hàng nhanh chóng của
                            chúng tôi.
                        </p>
                        <a class="button-red mb-8 uppercase" href="{{ route('client.product.menu') }}">đặt ngay</a>
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
                        <p class="vujahday-script-regular mb-4 text-3xl lg:text-4xl">Câu chuyện của chúng tôi</p>
                        <p class="mb-6 font-light lg:mb-8">Khám phá các loại Pizza nướng bằng củi, bia Bỉ và các món tráng
                            miệng mới làm mà bạn có thể thưởng thức tại 2 địa điểm của chúng tôi hoặc tại nhà với dịch vụ giao
                            hàng nhanh chóng của chúng tôi.
                        </p>
                        <p class="font-light mb-8">Ladybug Pizza là một tiệm bánh Pizza đích thực, nằm ở trung tâm Hà Nội. Những chiếc
                            bánh pizza của chúng tôi được nướng trong lò đốt củi và phủ bên trên những nguyên liệu tươi, tự
                            nhiên và được lựa chọn cẩn thận.
                        </p>
                        <p class="flex items-center justify-center mb-4">
                            <a class="button-red" href="{{ route('client.about-us') }}">VỀ CHÚNG TÔI</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

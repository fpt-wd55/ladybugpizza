@extends('layouts.client')


@section('title', 'Trang chủ')

@section('content')
    @session('success')
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endsession

    <div class="mx-auto px-0  ">
        <div id="default-carousel" class="z-0 relative w-full mb-[44px] md:mb-[76px] lg:mb-[64px]" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-[230px] overflow-hidden  md:h-[400px] lg:h-[650px]">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/uploads/banners/banner.jpg') }}"
                        class="object-cover absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="Test image">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/uploads/banners/banner.jpg') }}"
                        class=" object-cover absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="Test image">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/uploads/banners/banner.jpg') }}"
                        class="object-cover absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="Test image">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/uploads/banners/banner.jpg') }}"
                        class="object-cover absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="Test image">
                </div>
            </div>

            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="indicator" aria-current="false" aria-label="Slide 0"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="indicator" aria-current="false" aria-label="Slide 1"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="indicator" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="2"></button>
                <button type="button" class="indicator" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="3"></button>
            </div>

            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                    @svg('tabler-chevron-left', 'w-4 h-4 text-white')
                </span>
            </button>
            <button type="button"
                class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                    @svg('tabler-chevron-right', 'w-4 h-4 text-white')
                </span>
            </button>
        </div>

        <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">

            {{-- hot pizza --}}
            <div class="mb-32">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg font-semibold uppercase">Sản Phẩm Nổi Bật</p>
                    <a href="" class="link-lg">Xem thêm</a>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                        <a href="{{ route('client.product.show', $product->slug) }}"
                            class="product-card md:flex overflow-hidden">
                            <img src="http://127.0.0.1:8000/storage/uploads/products/pizza/pizza_4_ormaggi.webp"
                                class="flex-shrink-0 h-48 w-full md:w-1/3 md:h-full object-cover" alt="">
                            <div class="p-2 text-sm">
                                <p class="font-semibold mb-2 ">{{ $product->name }}</p>
                                <div class="flex items-center gap-1 mb-2">
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
                                <div class="bottom-4 flex gap-3 items-center">
                                    <p class="line-through text-xs text-gray-500">{{ number_format($product->price) }}đ</p>
                                    <p class="font-semibold">{{ number_format($product->discount_price) }}đ</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>

            {{-- kham pha thuc don --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 mb-32 gap-8">
                <div class="flex flex-col items-center mr-3 text-center">
                    <p class="text-center berkshire-swash-regular text-3xl lg:text-4xl mb-4">Khám Phá</p>
                    <p class="vujahday-script-regular text-3xl lg:text-4xl mb-6">
                        Thực đơn của chúng tôi</p>

                    <p class="font-extralight mb-8">
                        Khám phá các loại Pizza nướng bằng củi, bia Bỉ và các món tráng miệng mới làm mà bạn có
                        thể thưởng thức tại 2 địa điểm của chúng tôi hoặc tại nhà với dịch vụ giao hàng nhanh chóng của
                        chúng tôi.
                    </p>
                    <a href="" class="button-red uppercase mb-8">đặt ngay</a>
                    <div class="font-extralight">
                        <p class="font-normal">Dịch vụ bữa trưa</p>
                        <p class="mb-4">Từ 11am đến 3pm </p>
                        <p class="font-normal">Dịch vụ bữa tối</p>
                        <p class="mb-4">Từ 5pm đến 10pm</p>
                        <p class="mb-8">Xin lưu ý rằng gọi món lần cuối là 30 phút trước giờ đóng cửa</p>
                    </div>
                </div>

                <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}"
                    class="flex-shrink-0 h-full w-full rounded-lg object-cover" alt="">
            </div>

            {{-- Cau chuyen cua chung toi --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="grid grid-cols-2 grid-rows-2 gap-4">
                    <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}"
                        class="h-full w-full rounded-lg object-cover" alt="">
                    <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}"
                        class="h-full w-full rounded-lg object-cover" alt="">
                    <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}"
                        class="h-full w-full rounded-lg object-cover" alt="">
                    <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}"
                        class="h-full w-full rounded-lg object-cover" alt="">
                </div>
                <div class="text-center">
                    <p class="text-center berkshire-swash-regular text-3xl lg:text-4xl mb-4">Khám Phá</p>

                    <p class="text-3xl lg:text-4xl mb-4 vujahday-script-regular">Câu chuyện của chúng tôi</p>
                    <p class="mb-6 lg:mb-8">Khám phá các loại Pizza nướng bằng củi, bia Bỉ và các món tráng
                        miệng mới làm mà bạn có thể thưởng thức tại 2 địa điểm của chúng tôi hoặc tại nhà với dịch vụ giao
                        hàng nhanh chóng của chúng tôi.
                    </p>
                    <p class=" lg:mb-5">Ladybug Pizza là một tiệm bánh Pizza đích thực, nằm ở trung tâm Hà Nội. Những chiếc
                        bánh pizza của chúng tôi được nướng trong lò đốt củi và phủ bên trên những nguyên liệu tươi, tự
                        nhiên và được lựa chọn cẩn thận.
                    </p>
                    <p>
                        Tìm hiểu thêm
                        <a href="" class="link-lg uppercase">về chúng tôi</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

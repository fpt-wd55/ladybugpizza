@extends('layouts.client')


@section('title', 'Trang chủ')

@section('content')
<div class="mx-auto px-0">
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">

        <div class="text-center py-8 mt-12">
            <p class="vujahday-script-regular text-6xl text-center mb-6">Ladybug Pizza</p>
            <p class="uppercase text-gray-500 mb-12">Ngon đến từng miếng, đậm vị yêu thương</p>
            @include('clients.categories')
        </div>

        <div>
            {{-- carousel --}}
            <div id="default-carousel" class="relative w-full mb-8 md:mb-12" data-carousel="slide">
                <div class="relative h-56 md:h-96 lg:h-[540px] overflow-hidden rounded transition">
                    @foreach ($banners as $banner)
                    <link rel="preload" href="{{ asset('storage/uploads/banners/' . $banner->image) }}" as="image">
                    <div class="hidden transition duration-700" data-carousel-item>
                        <img src="{{ asset('storage/uploads/banners/' . $banner->image) }}" class="absolute block w-full h-full object-cover" alt="{{ $banner->image }}">
                    </div>
                    @endforeach
                </div>
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2">
                    @foreach ($banners as $index => $banner)
                    <button type="button" class="indicator" aria-current="true" data-carousel-slide-to="{{ $index }}"></button>
                    @endforeach
                </div>
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 text-white">
                        @svg('tabler-chevron-left', 'icon-sm')
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 text-white">
                        @svg('tabler-chevron-right', 'icon-sm')
                    </span>
                </button>
            </div>


            {{-- hot pizza --}}
            <div class="mb-32">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg font-semibold uppercase">Sản Phẩm Nổi Bật</p>
                    <a href="{{ route('client.product.menu') }}" class="link-lg">Xem thêm</a>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                    <a href="{{ route('client.product.show', $product->slug) }}" class="product-card md:flex overflow-hidden">
                        <img loading="lazy" src="{{ asset('storage/uploads/products/' . $product->image) }}" class="flex-shrink-0 h-48 w-full md:w-1/3 md:h-full object-cover" alt="">
                        <div class="p-2 text-sm">
                            <p class="font-semibold mb-2 ">{{ $product->name }}</p>
                            <div class="flex items-center gap-1 mb-2">
                                <p>{{ $product->avg_rating }}</p>
                                <div class="flex items-center gap-1">
                                    @for ($i = 0; $i < 5; $i++) @if ($i < $product->avg_rating)
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

            {{-- Khám phá thực đơn --}}
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
                    <a href="{{ route('client.product.menu') }}" class="button-red uppercase mb-8">đặt ngay</a>
                    <div class="font-extralight">
                        <p class="font-normal">Dịch vụ bữa trưa</p>
                        <p class="mb-4">Từ 11am đến 3pm </p>
                        <p class="font-normal">Dịch vụ bữa tối</p>
                        <p class="mb-4">Từ 5pm đến 10pm</p>
                        <p class="mb-8">Xin lưu ý rằng gọi món lần cuối là 30 phút trước giờ đóng cửa</p>
                    </div>
                </div>

                <img loading="lazy" src="{{ asset('storage/uploads/products/pizza-5-cheese.jpeg') }}" class="flex-shrink-0 h-full w-full rounded-lg object-cover" alt="">
            </div>

            {{-- Cau chuyen cua chung toi --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="grid grid-cols-2 grid-rows-2 gap-4">
                    <img loading="lazy" src="{{ asset('storage/uploads/products/pizza-margherita.jpeg') }}" class="h-full w-full rounded-lg object-cover" alt="">
                    <img loading="lazy" src="{{ asset('storage/uploads/products/pizza-4-cheese.jpeg') }}" class="h-full w-full rounded-lg object-cover" alt="">
                    <img loading="lazy" src="{{ asset('storage/uploads/products/pizza-burrata-cay.jpeg') }}" class="h-full w-full rounded-lg object-cover" alt="">
                    <img loading="lazy" src="{{ asset('storage/uploads/products/pizza-ca-hoi.jpg') }}" class="h-full w-full rounded-lg object-cover" alt="">
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
                        <a href="{{ route('client.about-us') }}" class="link-lg">Về chúng tôi</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.client')

@section('title', 'Hướng dẫn mua hàng')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="card p-4 md:p-8">
            <h2 class="font-semibold uppercase text-sm md:text-base mb-4">HƯỚNG DẪN MUA HÀNG</h2>

            {{-- Bước 1 --}}
            <div class="mb-4">
                <h3 class="font-semibold text-xs md:text-sm mb-4">Bước 1: Chọn khuyến mãi hoặc sản phẩm
                    trên thực đơn</h3>
                <div class="text-sm ps-4 leading-loose tracking-wide mb-4">
                    <ul class="list-disc ps-4">
                        <li>Chọn trực tiếp các Chương trình Khuyến mãi phù hợp trên Trang chủ</li>
                        <li>Chọn sản phẩm phù hợp trên thanh Thực đơn</li>
                        <li>Hoặc chọn nút Khuyến mãi để tham khảo chi tiết từng khuyến mãi đang áp dụng và chọn sản phẩm
                            phù
                            hợp</li>
                    </ul>
                </div>
                <div class="w-full lg:w-2/3 mx-auto mb-4">
                    <img loading="lazy" src="{{ asset('storage/uploads/banners/banner.jpg') }}" alt=""
                        class="object-cover w-full h-full rounded-md mb-2">
                    <p class="text-center italic text-sm">Mô tả hình ảnh</p>
                </div>
            </div>

            {{-- Bước 2A --}}
            <div class="mb-4">
                <h3 class="font-semibold text-xs md:text-sm mb-4">Bước 2A: Chọn sản phẩm cho khuyến mãi hoặc chọn sản
                    phẩm
                    riêng lẻ nguyên giá</h3>
                <div class="text-sm ps-4 leading-loose tracking-wide mb-4">
                    <ul class="list-disc ps-4">
                        <li>Chọn trực tiếp các Chương trình Khuyến mãi phù hợp trên Trang chủ.</li>
                        <li>Chọn sản phẩm phù hợp trên thanh Thực đơn.</li>
                        <li>Hoặc chọn nút Khuyến mãi để tham khảo chi tiết từng khuyến mãi đang áp dụng và chọn sản phẩm
                            phù
                            hợp.</li>
                    </ul>
                </div>
                <div class="w-full lg:w-2/3 mx-auto mb-4">
                    <img loading="lazy" src="{{ asset('storage/uploads/banners/banner.jpg') }}" alt=""
                        class="object-cover w-full h-full rounded-md mb-2">
                    <p class="text-center italic text-sm">Mô tả hình ảnh</p>
                </div>
                <div class="text-sm ps-4 leading-loose tracking-wide mb-4">
                    <ul class="list-disc ps-4">
                        <li>Hoặc chọn sản phẩm riêng lẻ nguyên giá có trên thanh Thực đơn ở Trang chủ.</li>
                        <li>Chọn sản phẩm phù hợp và chọn Thêm vào giỏ hàng để từng sản phẩm được ghi nhận vào Giỏ hàng.
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bước 2B --}}
            <div class="mb-4">
                <h3 class="font-semibold text-xs md:text-sm mb-4">Bước 2B: Chọn chi tiết sản phẩm (kích thước, đế, nhân,
                    ghi
                    chú...) đối với pizza và các sản phẩm đều có thể điều chỉnh theo nhu cầu</h3>
                <div class="text-sm ps-4 leading-loose tracking-wide mb-4">
                    <ul class="list-disc ps-4">
                        <li>Chọn trực tiếp các Chương trình Khuyến mãi phù hợp trên Trang chủ.</li>
                        <li>Chọn sản phẩm phù hợp trên thanh Thực đơn.</li>
                        <li>Hoặc chọn nút Khuyến mãi để tham khảo chi tiết từng khuyến mãi đang áp dụng và chọn sản phẩm
                            phù
                            hợp.</li>
                    </ul>
                </div>
                <div class="w-full lg:w-2/3 mx-auto mb-4">
                    <img loading="lazy" src="{{ asset('storage/uploads/banners/banner.jpg') }}" alt=""
                        class="object-cover w-full h-full rounded-md mb-2">
                    <p class="text-center italic text-sm">Mô tả hình ảnh</p>
                </div>
                <div class="text-sm ps-4 leading-loose tracking-wide mb-4">
                    <ul class="list-disc ps-4">
                        <li>Hoặc chọn sản phẩm riêng lẻ nguyên giá có trên thanh Thực đơn ở Trang chủ.</li>
                        <li>Chọn sản phẩm phù hợp và chọn Thêm vào giỏ hàng để từng sản phẩm được ghi nhận vào Giỏ hàng.
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>


@endsection

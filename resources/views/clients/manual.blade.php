@extends('layouts.client')

  
@section('title', 'Trang chính sách')

@section('content')
    @session('success')
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endsession

    <div class=" mx-5 mt-3 md:mx-6 lg:mx-8  card">
        <div class=" mx-4 mt-4">

            <p class="font-bold text-sm md:text-base lg:text-lg ">HƯỚNG DẪN MUA HÀNG</p>

         {{-- bước 1 --}}
            <div class="">
                <p class="font-bold text-xs mt-3 mb-3 md:text-sm md:mt-4 lg:text-lg">Bước 1: Chọn khuyến mãi hoặc sản phẩm trên thực đơn</p>
                <P class="text-xs md:text-sm lg:text-lg">
                    - Chọn trực tiếp các Chương trình Khuyến mãi phù hợp trên Trang chủ. <br>
                    - Chọn sản phẩm phù hợp trên thanh Thực đơn. <br>
                    - Hoặc chọn nút Khuyến mãi để tham khảo chi tiết từng khuyến mãi đang áp dụng và chọn sản phẩm phù hợp. <br>
                </P>
                <div class="w-auto h-[200px] md:h-[280px] lg:h-[380px]">
                     <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" alt="" class="object-cover w-full h-full rounded-md mt-4 mb-4">
                </div>
            </div>
        {{-- end bước 1 --}}

        {{-- bước 2A --}}
        <div class="">
            <p class="font-bold text-xs mt-3 mb-3 md:text-sm md:mt-4 lg:text-lg ">Bước 2A: chọn sản phẩm cho khuyến mãi hoặc chọn sản phẩm riêng lẻ nguyên giá</p>
            <P class="text-xs md:text-sm lg:text-lg">
                - Chọn trực tiếp các Chương trình Khuyến mãi phù hợp trên Trang chủ. <br>
                - Chọn sản phẩm phù hợp trên thanh Thực đơn. <br>
                - Hoặc chọn nút Khuyến mãi để tham khảo chi tiết từng khuyến mãi đang áp dụng và chọn sản phẩm phù hợp.
            </P>
            <div class="w-auto h-[200px] md:h-[280px]">
                 <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" alt="" class="object-cover w-full h-full rounded-md mt-4 ">
            </div>
            <P class="text-xs md:text-sm mt-3 lg:text-lg">
                - Hoặc chọn sản phẩm riêng lẻ nguyên giá có trên thanh Thực đơn ở Trang chủ. <br>
                - Chọn sản phẩm phù hợp và chọn Thêm vào giỏ hàng để từng sản phẩm được ghi nhận vào Giỏ hàng. <br>
            </P>
            <div class="w-auto h-[200px] md:h-[280px]">
                <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" alt="" class="object-cover w-full h-full rounded-md mt-4 mb-4">
           </div>
        </div>
        {{-- end bước 2A --}}

        {{-- bước 2B --}}
        <div class="mb-4">
            <p class="font-bold text-xs mt-3 mb-3 md:text-sm md:mt-4 lg:text-lg">Bước 2B: chọn chi tiết sản phẩm(kích thước, đế, nhân, ghi chú...) đối với pizza và các sản phẩm đều có thể điều chỉnh theo nhu cầu</p>
            <P class="text-xs md:text-sm lg:text-lg">
                - Chọn trực tiếp các Chương trình Khuyến mãi phù hợp trên Trang chủ. <br>
                - Chọn sản phẩm phù hợp trên thanh Thực đơn. <br>   
                - Hoặc chọn nút Khuyến mãi để tham khảo chi tiết từng khuyến mãi đang áp dụng và chọn sản phẩm phù hợp.
            </P>
            <div class="w-auto h-[200px] md:h-[280px]">
                 <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" alt="" class="object-cover w-full h-full rounded-md mt-4 ">
            </div>
            <P class="text-xs md:text-sm mt-3 lg:text-lg">
                - Hoặc chọn sản phẩm riêng lẻ nguyên giá có trên thanh Thực đơn ở Trang chủ. <br>
                - Chọn sản phẩm phù hợp và chọn Thêm vào giỏ hàng để từng sản phẩm được ghi nhận vào Giỏ hàng. <br>
            </P>
            <div class="w-auto h-[200px] md:h-[280px]">
                <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" alt="" class="object-cover w-full h-full rounded-md mt-4 mb-4">
           </div>
        </div>
        {{-- end bước 2B --}}


    
    
         



        </div>
    </div>

@endsection

@extends('layouts.client')
@section('title', 'Về chúng tôi')
@section('content')
    <div class="w-full">
        <img alt="" class="w-full object-cover" loading="lazy" src=" {{ asset('storage/uploads/banners/banner.jpg') }}">
    </div>
    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
        <div class="w-full">
            <div class="mt-6 text-center">
                <h2 class="vujahday-script-regular mt-12 text-6xl">Ladybug Pizza</h2>
                <div class="mb-8">
                    <p class="mt-12">Nằm ngay trung tâm Quận Hoàn Kiếm, Hà Nội, Ladybug Pizza là một tiệm pizza
                        phong cách người Napoli, được sáng lập bởi đầu bếp Kyle Jacovino. Với gần hai thập kỷ kinh nghiệm
                        trong
                        ngành ẩm thực và niềm tự hào về di sản Ý, Jacovino đã mang đến những chiếc pizza đặc trưng, được làm
                        từ bột lên men tự nhiên và nướng trong lò gạch truyền thống của Ý.
                    </p>
                    <p class="mt-12">Bột của từng chiếc pizza tại Ladybug Pizza được làm từ ngũ cốc hữu cơ tuyển
                        chọn từ
                        các nhà xay lúa địa
                        phương, ủ men trong vòng 48 giờ để tạo ra hương vị độc đáo. Pizza được nướng ở nhiệt độ từ 800 đến
                        825
                        độ C trong khoảng 90 giây, giúp vỏ bánh giòn rụm bên ngoài nhưng vẫn mềm mại bên trong.
                    </p>
                    <p class="mt-12">Ladybug Pizza nằm trong trung tâm Quận Hoàn Kiếm, Hà Nội – nơi tập trung các
                        quầy
                        ẩm
                        thực và xe bán đồ ăn lưu động tại Hà Nội. Nhà hàng được thiết kế theo phong cách cổ điển nhưng vẫn
                        tạo
                        ra không gian sáng
                        tạo, thân thiện, mang đậm nét văn hóa đô thị hiện đại của Hà Nội. Khi hoạt động, khách hàng có thể
                        thư
                        giãn tại khu vực sân ngoài trời, cùng thưởng thức pizza và thưởng thức các món ăn kèm đậm vị Ý, tận
                        hưởng không khí sôi động của thành phố.
                    </p>
                </div>
                <p class="title-lg">Giờ mở cửa & Địa điểm</p>
                <p>35 Đường Downing, <br>
                    New York, NY 10014 <br>
                    917-935-6434
                </p>
                <p>
                    Chúng tôi nằm trong khu Starland Yard Park. Bạn có thể tìm thấy chúng tôi ngay góc đường 40th và Desoto
                    Ave! Hãy
                    nhìn về phía bên phải của cổng vào để thấy container của chúng tôi!
                </p>
                <div class="mt-8">
                    <span class="font-medium">Thứ Hai - Thứ Năm </span>: 10h sáng - 8h tối <br>
                    <span class="font-medium">Thứ Sáu</span>: 12h trưa - 12h đêm <br>
                    <span class="font-medium">Thứ Bảy</span>: 11h sáng - 12h đêm <br>
                    <span class="font-medium">Chủ Nhật</span>: 11h sáng - 10h tối
                </div>

            </div>
            <div class="flex justify-center">
                <button class="button-red mt-12 uppercase">Đặt ngay</button>
            </div>
        </div>
        <div class="mt-10 grid grid-cols-2 gap-4 md:gap-8">
            <img alt="" class="rounded-md" loading="lazy" src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}">
            <img alt="" class="rounded-md" loading="lazy" src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}">
            <img alt="" class="rounded-md" loading="lazy" src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}">
            <img alt="" class="rounded-md" loading="lazy" src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}">
        </div>
    </div>
@endsection

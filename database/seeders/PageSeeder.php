<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::insert([
            [
                'title' => 'Về chúng tôi',
                'slug' => 've-chung-toi',
                'content' => '
                    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32 comfortable">
                    <div class="w-full">
                    <div class="mt-6 text-center">
                    <h2 class="vujahday-script-regular mt-12 text-6xl">Ladybug Pizza</h2>
                    <div class="mb-8">
                    <p class="mt-12">Nằm ngay trung t&acirc;m Quận Ho&agrave;n Kiếm, H&agrave; Nội, Ladybug Pizza l&agrave; một tiệm pizza phong c&aacute;ch người Napoli, được s&aacute;ng lập bởi đầu bếp Kyle Jacovino. Với gần hai thập kỷ kinh nghiệm trong ng&agrave;nh ẩm thực v&agrave; niềm tự h&agrave;o về di sản &Yacute;, Jacovino đ&atilde; mang đến những chiếc pizza đặc trưng, được l&agrave;m từ bột l&ecirc;n men tự nhi&ecirc;n v&agrave; nướng trong l&ograve; gạch truyền thống của &Yacute;.</p>
                    <p class="mt-12">Bột của từng chiếc pizza tại Ladybug Pizza được l&agrave;m từ ngũ cốc hữu cơ tuyển chọn từ c&aacute;c nh&agrave; xay l&uacute;a địa phương, ủ men trong v&ograve;ng 48 giờ để tạo ra hương vị độc đ&aacute;o. Pizza được nướng ở nhiệt độ từ 800 đến 825 độ C trong khoảng 90 gi&acirc;y, gi&uacute;p vỏ b&aacute;nh gi&ograve;n rụm b&ecirc;n ngo&agrave;i nhưng vẫn mềm mại b&ecirc;n trong.</p>
                    <p class="mt-12">Ladybug Pizza nằm trong trung t&acirc;m Quận Ho&agrave;n Kiếm, H&agrave; Nội &ndash; nơi tập trung c&aacute;c quầy ẩm thực v&agrave; xe b&aacute;n đồ ăn lưu động tại H&agrave; Nội. Nh&agrave; h&agrave;ng được thiết kế theo phong c&aacute;ch cổ điển nhưng vẫn tạo ra kh&ocirc;ng gian s&aacute;ng tạo, th&acirc;n thiện, mang đậm n&eacute;t văn h&oacute;a đ&ocirc; thị hiện đại của H&agrave; Nội. Khi hoạt động, kh&aacute;ch h&agrave;ng c&oacute; thể thư gi&atilde;n tại khu vực s&acirc;n ngo&agrave;i trời, c&ugrave;ng thưởng thức pizza v&agrave; thưởng thức c&aacute;c m&oacute;n ăn k&egrave;m đậm vị &Yacute;, tận hưởng kh&ocirc;ng kh&iacute; s&ocirc;i động của th&agrave;nh phố.</p>
                    </div>
                    <p class="playwrite-gb-s-regular mb-6 text-lg uppercase">Giờ mở cửa &amp; Địa điểm</p>
                    <p>35 Đường Downing, <br>New York, NY 10014 <br>917-935-6434</p>
                    <p>Ch&uacute;ng t&ocirc;i nằm trong khu Starland Yard Park. Bạn c&oacute; thể t&igrave;m thấy ch&uacute;ng t&ocirc;i ngay g&oacute;c đường 40th v&agrave; Desoto Ave! H&atilde;y nh&igrave;n về ph&iacute;a b&ecirc;n phải của cổng v&agrave;o để thấy container của ch&uacute;ng t&ocirc;i!</p>
                    <div class="mt-8"><span class="font-bold">Thứ Hai - Thứ Năm </span>: 10h s&aacute;ng - 8h tối <br><span class="font-bold">Thứ S&aacute;u</span>: 12h trưa - 12h đ&ecirc;m <br><span class="font-bold">Thứ Bảy</span>: 11h s&aacute;ng - 12h đ&ecirc;m <br><span class="font-bold">Chủ Nhật</span>: 11h s&aacute;ng - 10h tối</div>
                    </div>
                    <div class="flex justify-center"><button class="button-primary mt-12 uppercase">Đặt ngay</button></div>
                    </div>
                    <div class="mt-10 grid grid-cols-2 gap-4 md:gap-8"><img class="rounded-md" src="{{ asset("storage/uploads/products/pizza/pizza_pesto_burrata.jpeg") }}" alt="" loading="lazy"> <img class="rounded-md" src="{{ asset("storage/uploads/products/pizza/pizza_pesto_burrata.jpeg") }}" alt="" loading="lazy"> <img class="rounded-md" src="{{ asset("storage/uploads/products/pizza/pizza_pesto_burrata.jpeg") }}" alt="" loading="lazy"> <img class="rounded-md" src="{{ asset("storage/uploads/products/pizza/pizza_pesto_burrata.jpeg") }}" alt="" loading="lazy"></div>
                    </div>    
                ',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Chính sách và điều khoản',
                'slug' => 'chinh-sach-va-dieu-khoan',
                'content' => '
                    <h1>Chính sách giao hàng</h1>

                    <h2>1. Thông tin cá nhân mà The Ladybugs Pizza thu thập</h2>
                    <p>The Ladybugs Pizza Vietnam có thể thu thập thông tin cá nhân của khách hàng bao gồm họ tên, địa chỉ, số CMND và số điện thoại di động, địa chỉ email, thông tin thẻ tín dụng và bất kỳ thông tin nào khác nếu bạn đồng ý cung cấp cho chúng tôi. Thông tin này sẽ được thu thập khi khách hàng:</p>
                    <ul>
                        <li>Đăng nhập vào website của The Ladybugs Pizza;</li>
                        <li>Tham gia các cuộc thi và khuyến mãi;</li>
                        <li>Tham gia khảo sát theo các chương trình khảo sát của The Ladybugs Pizza và các đối tác (nếu có);</li>
                        <li>Gửi email đến The Ladybugs Pizza;</li>
                        <li>Đăng ký thành viên của The Ladybugs Pizza;</li>
                        <li>Phản hồi yêu cầu của khách hàng;</li>
                        <li>Đặt pizza tại các cửa hàng của The Ladybugs Pizza trên toàn quốc hoặc qua website của The Ladybugs Pizza;</li>
                    </ul>

                    <h2>2. Mục đích sử dụng thông tin cá nhân</h2>
                    <p>The Ladybugs Pizza có thể sử dụng thông tin cá nhân do khách hàng cung cấp và xử lý thông tin đó để cung cấp hàng hóa và dịch vụ cho khách hàng, và thực hiện các chương trình của The Ladybugs Pizza và/hoặc các đối tác của The Ladybugs Pizza, miễn là các chương trình này được thực hiện một cách công khai và minh bạch. Thông tin cá nhân sẽ được sử dụng để:</p>
                    <ul>
                        <li>Quản lý thành viên website nếu bạn đã đăng ký thành viên;</li>
                        <li>Cung cấp cho khách hàng thông tin về công ty theo yêu cầu;</li>
                        <li>Xử lý đơn hàng qua website;</li>
                        <li>Thông báo cho khách hàng về các thay đổi trên website;</li>
                        <li>Gửi khuyến mãi hoặc thông tin về sản phẩm và dịch vụ mà chúng tôi cho là có lợi cho khách hàng;</li>
                    </ul>

                    <h2>3. Ai sẽ chia sẻ thông tin?</h2>
                    <p>The Ladybugs Pizza sẽ không cung cấp bất kỳ thông tin cá nhân nào của khách hàng cho các bên thứ ba không liên quan. Tuy nhiên, trong một số trường hợp nhất định, chúng tôi có thể chia sẻ thông tin với:</p>
                    <ul>
                        <li>Các nhà cung cấp dịch vụ mà chúng tôi thuê để gửi thư cho khách hàng;</li>
                        <li>Các cơ quan chính phủ khi có yêu cầu theo quy định pháp luật;</li>
                    </ul>

                    <h1>Chính sách bảo mật</h1>

                    <p>Nội dung chính sách bảo mật của The Ladybugs Pizza tương tự như chính sách giao hàng, với các điều khoản cụ thể về bảo vệ thông tin cá nhân và quyền riêng tư của khách hàng.</p>   
                ',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Hướng dẫn mua hàng',
                'slug' => 'huong-dan-mua-hang',
                'content' => '
                    <h1>Hướng dẫn mua hàng</h1>

                    <h2>BƯỚC 1: CHỌN KHUYẾN MÃI HOẶC SẢN PHẨM TRÊN THỰC ĐƠN</h2>
                    <ul>
                        <li>Chọn trực tiếp các Chương trình Khuyến mãi phù hợp trên Trang chủ.</li>
                        <li>Chọn sản phẩm phù hợp trên thanh Thực đơn.</li>
                        <li>Hoặc chọn nút Khuyến mãi để tham khảo chi tiết từng khuyến mãi đang áp dụng và chọn sản phẩm phù hợp.</li>
                    </ul>

                    <h2>BƯỚC 2A: CHỌN SẢN PHẨM CHO KHUYẾN MÃI HOẶC CHỌN SẢN PHẨM RIÊNG LẺ NGUYÊN GIÁ</h2>
                    <ul>
                        <li>Chọn trực tiếp các Chương trình Khuyến mãi phù hợp trên Trang chủ.</li>
                        <li>Chọn sản phẩm phù hợp trên thanh Thực đơn.</li>
                        <li>Hoặc chọn nút Khuyến mãi để tham khảo chi tiết từng khuyến mãi đang áp dụng và chọn sản phẩm phù hợp.</li>
                        <li>Hoặc chọn sản phẩm riêng lẻ nguyên giá có trên thanh Thực đơn ở Trang chủ.</li>
                        <li>Chọn sản phẩm phù hợp và chọn "Thêm vào giỏ hàng" để từng sản phẩm được ghi nhận vào Giỏ hàng.</li>
                    </ul>

                    <h2>BƯỚC 2B: CHỌN CHI TIẾT SẢN PHẨM (KÍCH THƯỚC, ĐẾ, NHÂN, GHI CHÚ...) ĐỐI VỚI PIZZA VÀ CÁC SẢN PHẨM CÓ THỂ ĐIỀU CHỈNH THEO NHU CẦU</h2>
                    <ul>
                        <li>Chọn trực tiếp các Chương trình Khuyến mãi phù hợp trên Trang chủ.</li>
                        <li>Chọn sản phẩm phù hợp trên thanh Thực đơn.</li>
                        <li>Hoặc chọn nút Khuyến mãi để tham khảo chi tiết từng khuyến mãi đang áp dụng và chọn sản phẩm phù hợp.</li>
                        <li>Hoặc chọn sản phẩm riêng lẻ nguyên giá có trên thanh Thực đơn ở Trang chủ.</li>
                        <li>Chọn sản phẩm phù hợp và chọn "Thêm vào giỏ hàng" để từng sản phẩm được ghi nhận vào Giỏ hàng.</li>
                    </ul>
                ',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

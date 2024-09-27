<?php

namespace Database\Seeders;

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
        DB::table('pages')->insert([
            [
                'title' => 'Về chúng tôi',
                'slug' => 've-chung-toi',
                'content' => '
                    <h1>VỀ LADYBUGS PIZZA</h1>
                    <p>Located in the heart of Savannah’s Starland district in the Starland Yard complex, Pizzeria Vittoria is a Neapolitan-inspired pizzeria showcasing naturally-leavened pizza from chef/owner Kyle Jacovino (The Florence, Five & Ten). At Vittoria, Jacovino draws from his nearly two decades of culinary experience and Italian-American heritage to craft pizzas that are an expression of regionality and his commitment to the Slow Food Movement.</p>
                    <p>Meticulously crafted with local organic grains sourced from regional millers such as Anson Mills and Lindley Mills, Jacovino’s prized dough ferments for up to 48 hours before being fired in a hand-built Neapolitan Giovanni Acunto brick oven. Baked for 90 seconds between 800 and 825 degrees.</p>
                    <p>A focal point within the Starland Yard, Vittoria is the only brick-and-mortar space within the complex, conceptualized as a food truck park. Constructed out of a shipping container, the restaurant is a functional canvas for Jacovino’s talent and craft, mirroring the surrounding community’s creative culture. When operational, an adjacent patio invites guests to linger, sharing pies and tipping back glasses of wine and beer.</p>
                    <h1>Ladybugs Pizza</h1>
                    <h2>GIỜ MỞ CỬA VÀ ĐỊA ĐIỂM</h2>
                    <p>35 Downing Street,<br>
                    New York, NY 10014<br>
                    917-935-6434</p>

                    <p>We’re located inside the Starland Yard Park. You can find us right on the corner of 40th and Desoto Ave! Look for our shipping container to the right of the entrance!</p>

                    <h3>Giờ Mở Cửa:</h3>
                    <ul>
                        <li>Monday - Thursday: 10AM - 8PM</li>
                        <li>Friday: 12PM - 12AM</li>
                        <li>Saturday: 11AM - 12AM</li>
                        <li>Sunday: 11AM - 10PM</li>
                    </ul>    
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

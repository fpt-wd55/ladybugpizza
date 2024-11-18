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
                     <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
                        <div class="card p-4 md:p-8">
                            {{-- Chính sách giao hàng --}}
                            <section class="mb-4">
                                <h2 class="font-semibold uppercase text-sm md:text-base mb-4">CHÍNH SÁCH GIAO HÀNG</h2>
                                {{-- Thông tin thu thập --}}
                                <div class="mb-4">
                                    <h3 class="font-semibold text-xs md:text-sm mb-4">1. Thông tin thu thập:</h3>
                                    <div class="text-sm ps-4 leading-loose tracking-wide">
                                        <p>Ladybug Pizza có thể thu thập thông tin cá nhân của khách hàng bao gồm: họ tên, địa chỉ, số CMND
                                            và số điện thoại di động, địa chỉ email, thông tin thẻ tín dụng, và bất kỳ thông tin nào khác
                                            nếu bạn đồng ý cung cấp. Thông tin này sẽ được thu thập khi khách hàng:</p>
                                        <ul class="list-disc ps-4">
                                            <li>Đăng nhập vào website của Ladybug Pizza;</li>
                                            <li>Tham gia các cuộc thi và chương trình khuyến mãi;</li>
                                            <li>Tham gia khảo sát theo chương trình khảo sát của Ladybug Pizza và các đối tác (nếu có);</li>
                                            <li>Gửi email đến Ladybug Pizza;</li>
                                            <li>Đăng ký thành viên của Ladybug Pizza;</li>
                                            <li>Phản hồi các yêu cầu của khách hàng;</li>
                                            <li>Đặt pizza tại các cửa hàng của Ladybug Pizza trên toàn quốc hoặc trên website của Ladybug
                                                Pizza.</li>
                                            <li>Nếu Ladybug Pizza thu thập thông tin cá nhân của bạn từ người khác, chúng tôi sẽ có các bước
                                                hợp lý để thông báo cho bạn.</li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- Mục đích sử dụng thông tin --}}
                                <div class="mb-4">
                                    <h3 class="font-semibold text-xs md:text-sm mb-4">2. Mục đích sử dụng thông tin:</h3>
                                    <div class="text-sm ps-4 leading-loose tracking-wide">
                                        <p>Ladybug Pizza có thể sử dụng thông tin cá nhân do khách hàng cung cấp để cung cấp hàng hóa và
                                            dịch vụ, thực hiện các chương trình của Ladybug Pizza và/hoặc các đối tác của chúng tôi, với
                                            điều kiện các chương trình này được thực hiện một cách công khai và minh bạch. Cụ thể, chúng tôi
                                            sẽ sử dụng thông tin cá nhân cho các mục đích sau:</p>
                                        <ul class="list-disc ps-4">
                                            <li>Quản lý thành viên của website nếu bạn đã đăng ký làm thành viên;</li>
                                            <li>Cung cấp thông tin mà khách hàng yêu cầu về công ty;</li>
                                            <li>Xử lý đơn hàng qua website;</li>
                                            <li>Định lượng số lượng khách hàng truy cập vào website;</li>
                                            <li>Thông báo giải thưởng và mua sắm;</li>
                                            <li>Phản hồi các yêu cầu cụ thể của khách hàng;</li>
                                            <li>Thông báo cho khách hàng về các thay đổi trên website;</li>
                                            <li>Quản lý các chương trình nghiên cứu thị trường;</li>
                                            <li>Gửi thông tin khuyến mãi hoặc thông tin về sản phẩm và dịch vụ mà chúng tôi cho là có lợi
                                                cho khách hàng;</li>
                                            <li>Các chương trình khác liên quan đến nội dung trên và/hoặc cung cấp các tiện ích khác cho
                                                khách hàng thông qua các chương trình của Ladybug Pizza và các đối tác.</li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- Chia sẻ thông tin --}}
                                <div class="mb-4">
                                    <h3 class="font-semibold text-xs md:text-sm mb-4">3. Chia sẻ thông tin:</h3>
                                    <div class="text-sm ps-4 leading-loose tracking-wide">
                                        <p class="mb-4">Ladybug Pizza sẽ không cung cấp thông tin cá nhân của khách hàng cho bên thứ ba
                                            không liên quan đến Ladybug Pizza và không cho phép bên thứ ba sử dụng thông tin này để tiếp thị
                                            trực tiếp đến khách hàng. Chúng tôi có thể sử dụng các công ty liên quan để vận hành và duy trì
                                            website hoặc cho các mục đích khác liên quan đến hoạt động kinh doanh, và các công ty này sẽ
                                            nhận thông tin khách hàng để thực hiện các yêu cầu của Ladybug Pizza. Chúng tôi có quyền chia sẻ
                                            thông tin cá nhân của khách hàng trong một số trường hợp khi cơ quan chính phủ có yêu cầu thông
                                            tin, phục vụ mục đích điều tra hoặc các yêu cầu khác theo quy định của pháp luật.</p>
                                        <p>Thông tin cá nhân mà khách hàng đã đăng ký trên website có thể được chia sẻ với các bên thứ ba
                                            của Ladybug Pizza trong các trường hợp sau:</p>
                                        <ul class="list-disc ps-4">
                                            <li>Các nhà cung cấp được chúng tôi thuê để cung cấp một số dịch vụ nhất định như gửi thư đến
                                                khách hàng;</li>
                                            <li>Để đáp ứng mục đích của khách hàng khi đăng ký thông tin cá nhân;</li>
                                            <li>Nếu khách hàng đồng ý chia sẻ thông tin cá nhân này;</li>
                                            <li>Nếu chính phủ yêu cầu chia sẻ thông tin cá nhân này;</li>
                                            <li>Nếu thông tin cá nhân của khách hàng được thu thập bởi một đơn vị tiếp thị, nó sẽ được cung
                                                cấp cho đơn vị tiếp thị này để phục vụ mục đích nghiên cứu và tiếp thị.</li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- Bảo mật thông tin --}}
                                <div class="mb-4">
                                    <h3 class="font-semibold text-xs md:text-sm mb-4">4. Bảo mật thông tin:</h3>
                                    <div class="text-sm ps-4 leading-loose tracking-wide">
                                        <p>Ladybug Pizza sẽ thực hiện các biện pháp an ninh để bảo vệ thông tin cá nhân của khách hàng khỏi
                                            mất mát, lạm dụng hoặc thay đổi thông tin cá nhân. Chúng tôi sử dụng các biện pháp an ninh như
                                            mã hóa thông tin cá nhân, sử dụng phần mềm bảo mật, mật khẩu để bảo vệ thông tin cá nhân của
                                            khách hàng. Chúng tôi cũng yêu cầu các nhân viên của chúng tôi tuân thủ các quy định về bảo mật
                                            thông tin cá nhân của khách hàng.</p>
                                    </div>
                                </div>
                            </section>
                            {{-- Chính sách bảo mật --}}
                            <section class="mb-4">
                                <h2 class="font-semibold uppercase text-sm md:text-base mb-4">CHÍNH SÁCH BẢO MẬT</h2>
                                {{-- Thông tin thu thập --}}
                                <div class="mb-4">
                                    <h3 class="font-semibold text-xs md:text-sm mb-4">1. Thông tin thu thập:</h3>
                                    <div class="text-sm ps-4 leading-loose tracking-wide">
                                        <p>Ladybug Pizza có thể thu thập thông tin cá nhân từ khách hàng như đã mô tả trong phần chính sách
                                            giao hàng. Thông tin này sẽ được thu thập trong các trường hợp tương tự.</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h3 class="font-semibold text-xs md:text-sm mb-4">2. Mục đích sử dụng thông tin:</h3>
                                    <div class="text-sm ps-4 leading-loose tracking-wide">
                                        <p>Ladybug Pizza sẽ sử dụng thông tin cá nhân của khách hàng cho các mục đích tương tự như đã nêu
                                            trong phần chính sách giao hàng.</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h3 class="font-semibold text-xs md:text-sm mb-4">3. Chia sẻ thông tin:</h3>
                                    <div class="text-sm ps-4 leading-loose tracking-wide">
                                        <p>Thông tin cá nhân của khách hàng sẽ được chia sẻ theo chính sách bảo mật của Ladybug Pizza tương
                                            tự như trong chính sách giao hàng.</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h3 class="font-semibold text-xs md:text-sm mb-4">4. Bảo mật thông tin:</h3>
                                    <div class="text-sm ps-4 leading-loose tracking-wide">
                                        <p>Chúng tôi sẽ thực hiện các biện pháp bảo mật để bảo vệ thông tin cá nhân theo các phương pháp như
                                            đã nêu trong phần chính sách giao hàng.</p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                ',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Hướng dẫn mua hàng',
                'slug' => 'huong-dan-mua-hang',
                'content' => '
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
                    <img loading="lazy" src="{{ asset("storage/uploads/banners/banner.jpg") }}" alt=""
                        class="object-cover w-full h-full rounded-md mb-2">
                    <p class="text-center italic text-sm">Mô tả hình ảnh</p>
                </div>
            </div>
            {{-- Bước 2A --}}
            <div class="mb-4">
                <h3 class="font-semibold text-xs md:text-sm mb-4">Bước 2A: Chọn sản phẩm cho khuyến mãi hoặc chọn sản phẩm riêng lẻ nguyên giá</h3>
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
                    <img loading="lazy" src="{{ asset("storage/uploads/banners/banner.jpg") }}" alt=""
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
                    <img loading="lazy" src="{{ asset("storage/uploads/banners/banner.jpg") }}" alt=""
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
                ',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

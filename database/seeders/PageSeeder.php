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
                    <p class="mt-12">Nằm tại Tòa nhà FPT Polytechnic, số 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, Hà Nội, Ladybug Pizza là một thương hiệu pizza phong cách Napoli nổi tiếng, mang đến hương vị Ý truyền thống với sự chăm chút trong từng chi tiết.</p>
                    <p class="mt-12">Ladybug Pizza được sáng lập bởi đầu bếp Kyle Jacovino, người đã có gần hai thập kỷ kinh nghiệm trong ngành ẩm thực và niềm đam mê mãnh liệt với văn hóa ẩm thực Ý. Các món pizza tại đây được làm từ bột lên men tự nhiên, chế biến từ ngũ cốc hữu cơ tuyển chọn và ủ men trong vòng 48 giờ để tạo nên hương vị đặc trưng. Bánh được nướng trong lò gạch truyền thống của Ý ở nhiệt độ từ 800 đến 825 độ C, chỉ trong 90 giây, mang đến lớp vỏ bánh giòn tan bên ngoài và mềm mại bên trong.</p>
                    <p class="mt-12">Không gian tại Ladybug Pizza được thiết kế tinh tế, kết hợp phong cách cổ điển và hiện đại, mang lại sự thoải mái và thân thiện cho khách hàng. Bên cạnh đó, khu vực sân ngoài trời là nơi lý tưởng để bạn vừa thưởng thức pizza, vừa cảm nhận không khí thư thái và sôi động của thành phố.</p>
                    </div>
                    <p class="playwrite-gb-s-regular mb-6 text-lg uppercase">Giờ mở cửa &amp; Địa điểm</p>
                    <div class="my-8"><span class="font-bold">Thứ Hai - Thứ Năm </span>: 10h s&aacute;ng - 8h tối <br><span class="font-bold">Thứ S&aacute;u</span>: 12h trưa - 12h đ&ecirc;m <br><span class="font-bold">Thứ Bảy</span>: 11h s&aacute;ng - 12h đ&ecirc;m <br><span class="font-bold">Chủ Nhật</span>: 11h s&aacute;ng - 10h tối</div>
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
                            <section class="mb-4">
                                <h2 class="font-semibold uppercase text-sm md:text-base mb-4">CHÍNH SÁCH GIAO HÀNG</h2>
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
                            <section class="mb-4">
                                <h2 class="font-semibold uppercase text-sm md:text-base mb-4">CHÍNH SÁCH BẢO MẬT</h2>
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
                            <h2 class="font-semibold uppercase text-lg md:text-md mb-4" style="text-align: center;">HƯỚNG DẪN MUA
                                H&Agrave;NG</h2>
                            <div class="mb-4">
                                <h3 class="font-semibold text-sm md:text-md mb-4">Bước 1. Chọn sản phẩm y&ecirc;u th&iacute;ch</h3>
                                <div class="text-sm md:text-md ps-4 leading-loose tracking-wide mb-4">
                                    <ul class="list-disc ps-4">
                                        <li>Truy cập v&agrave;o trang thực đơn của ch&uacute;ng t&ocirc;i.</li>
                                        <li>Lựa chọn m&oacute;n pizza ph&ugrave; hợp với khẩu vị của bạn, từ c&aacute;c loại truyền thống
                                            như Margherita, Pepperoni, đến những m&oacute;n đặc biệt như Pizza Hải Sản hay Pizza Chay.</li>
                                        <li>Ngo&agrave;i pizza, bạn c&oacute; thể th&ecirc;m nước uống, m&oacute;n phụ như khoai t&acirc;y
                                            chi&ecirc;n hoặc salad để bữa ăn th&ecirc;m trọn vẹn.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="font-semibold text-sm md:text-md mb-4">Bước 2. T&ugrave;y chỉnh m&oacute;n ăn</h3>
                                <div class="text-sm md:text-md ps-4 leading-loose tracking-wide mb-4">
                                    <ul class="list-disc ps-4">
                                        <li>Chọn k&iacute;ch thước, loại đế, sốt pizza</li>
                                        <li>Chọn th&ecirc;m topping (nếu c&oacute;)</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="font-semibold text-sm md:text-md mb-4">Bước 3. Th&ecirc;m v&agrave;o giỏ h&agrave;ng</h3>
                                <div class="text-sm md:text-md ps-4 leading-loose tracking-wide mb-4">
                                    <ul class="list-disc ps-4">
                                        <li>Sau khi chọn m&oacute;n, nhấn n&uacute;t &ldquo;Th&ecirc;m v&agrave;o giỏ h&agrave;ng&rdquo;.
                                        </li>
                                        <li>Kiểm tra lại giỏ h&agrave;ng để chắc chắn rằng bạn đ&atilde; chọn đ&uacute;ng m&oacute;n
                                            v&agrave; số lượng mong muốn.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="font-semibold text-sm md:text-md mb-4">4. Điền th&ocirc;ng tin giao h&agrave;ng</h3>
                                <div class="text-sm md:text-md ps-4 leading-loose tracking-wide mb-4">
                                    <ul class="list-disc ps-4">
                                        <li>Nhấn &ldquo;Thanh to&aacute;n&rdquo; để đi đến trang thanh to&aacute;n.</li>
                                        <li>Điền đầy đủ th&ocirc;ng tin:
                                            <ul>
                                                <li>T&ecirc;n người nhận</li>
                                                <li>Số điện thoại li&ecirc;n hệ</li>
                                                <li>Địa chỉ giao h&agrave;ng</li>
                                                <li>Chọn thời gian giao h&agrave;ng mong muốn (nếu c&oacute;).</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="font-semibold text-sm md:text-md mb-4">5. Chọn phương thức thanh to&aacute;n</h3>
                                <div class="text-sm md:text-md ps-4 leading-loose tracking-wide mb-4">
                                    <p>Ch&uacute;ng t&ocirc;i hỗ trợ c&aacute;c phương thức thanh to&aacute;n sau:</p>
                                    <ul class="list-disc ps-4">
                                        <ul>
                                            <li>Thanh to&aacute;n khi nhận h&agrave;ng (COD).&nbsp;</li>
                                            <li>Thanh to&aacute;n qua v&iacute; điện tử Momo</li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="font-semibold text-sm md:text-md mb-4">6. X&aacute;c nhận đơn h&agrave;ng</h3>
                                <div class="text-sm md:text-md ps-4 leading-loose tracking-wide mb-4">
                                    <ul class="list-disc ps-4">
                                        <li>Kiểm tra lại to&agrave;n bộ th&ocirc;ng tin đơn h&agrave;ng.</li>
                                        <li>Nhấn n&uacute;t <strong>&ldquo;X&aacute;c nhận đặt h&agrave;ng&rdquo;</strong>.</li>
                                        <li>Hệ thống sẽ gửi một email hoặc tin nhắn x&aacute;c nhận đơn h&agrave;ng của bạn.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="font-semibold text-sm md:text-md mb-4">7. Chờ giao h&agrave;ng</h3>
                                <div class="text-sm md:text-md ps-4 leading-loose tracking-wide mb-4">
                                    <ul class="list-disc ps-4">
                                        <li>Đội ngũ của ch&uacute;ng t&ocirc;i sẽ bắt đầu chế biến ngay khi nhận được đơn h&agrave;ng.</li>
                                        <li>Pizza sẽ được giao đến tận nơi, đảm bảo <strong>n&oacute;ng hổi</strong> v&agrave;
                                            <strong>đ&uacute;ng giờ</strong>.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="font-semibold text-sm md:text-md mb-4">Hỗ trợ kh&aacute;ch h&agrave;ng</h3>
                                <div class="text-sm md:text-md ps-4 leading-loose tracking-wide mb-4">
                                    <ul class="list-disc ps-4">
                                        <li>Nếu cần hỗ trợ hoặc c&oacute; thay đổi về đơn h&agrave;ng, h&atilde;y li&ecirc;n hệ với
                                            ch&uacute;ng t&ocirc;i qua:
                                            <ul>
                                                <li><strong>Hotline</strong>: (+84) 382 606 012</li>
                                                <li><strong>Email</strong>: lv.thanh137@gmail.com&nbsp;</li>
                                            </ul>
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

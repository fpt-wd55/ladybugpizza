@extends('layouts.client')

@section('title', 'Chính sách')

@section('content')
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="card p-4 md:p-8">
            {{-- Chính sách giao hàng --}}
            <section class="mb-4">
                <h2 class="font-semibold uppercase text-sm md:text-base mb-4">CHÍNH SÁCH GIAO HÀNG</h2>

                {{-- Thông tin thu thập --}}
                <div class="mb-4">
                    <h3 class="font-semibold text-xs md:text-sm mb-4">1. Thông tin thu thập:</h3>
                    <div class="text-sm ps-4 leading-loose tracking-wide">
                        <p>Ladybug Pizza có thể thu thập thông tin cá nhân của khách hàng bao gồm: họ tên, địa chỉ, số CMND và số điện thoại di động, địa chỉ email, thông tin thẻ tín dụng, và bất kỳ thông tin nào khác nếu bạn đồng ý cung cấp. Thông tin này sẽ được thu thập khi khách hàng:</p>
                        <ul class="list-disc ps-4">
                            <li>Đăng nhập vào website của Ladybug Pizza;</li>
                            <li>Tham gia các cuộc thi và chương trình khuyến mãi;</li>
                            <li>Tham gia khảo sát theo chương trình khảo sát của Ladybug Pizza và các đối tác (nếu có);</li>
                            <li>Gửi email đến Ladybug Pizza;</li>
                            <li>Đăng ký thành viên của Ladybug Pizza;</li>
                            <li>Phản hồi các yêu cầu của khách hàng;</li>
                            <li>Đặt pizza tại các cửa hàng của Ladybug Pizza trên toàn quốc hoặc trên website của Ladybug Pizza.</li>
                            <li>Nếu Ladybug Pizza thu thập thông tin cá nhân của bạn từ người khác, chúng tôi sẽ có các bước hợp lý để thông báo cho bạn.</li>
                        </ul>
                    </div>
                </div>

                {{-- Mục đích sử dụng thông tin --}}
                <div class="mb-4">
                    <h3 class="font-semibold text-xs md:text-sm mb-4">2. Mục đích sử dụng thông tin:</h3>
                    <div class="text-sm ps-4 leading-loose tracking-wide">
                        <p>Ladybug Pizza có thể sử dụng thông tin cá nhân do khách hàng cung cấp để cung cấp hàng hóa và dịch vụ, thực hiện các chương trình của Ladybug Pizza và/hoặc các đối tác của chúng tôi, với điều kiện các chương trình này được thực hiện một cách công khai và minh bạch. Cụ thể, chúng tôi sẽ sử dụng thông tin cá nhân cho các mục đích sau:</p>
                        <ul class="list-disc ps-4">
                            <li>Quản lý thành viên của website nếu bạn đã đăng ký làm thành viên;</li>
                            <li>Cung cấp thông tin mà khách hàng yêu cầu về công ty;</li>
                            <li>Xử lý đơn hàng qua website;</li>
                            <li>Định lượng số lượng khách hàng truy cập vào website;</li>
                            <li>Thông báo giải thưởng và mua sắm;</li>
                            <li>Phản hồi các yêu cầu cụ thể của khách hàng;</li>
                            <li>Thông báo cho khách hàng về các thay đổi trên website;</li>
                            <li>Quản lý các chương trình nghiên cứu thị trường;</li>
                            <li>Gửi thông tin khuyến mãi hoặc thông tin về sản phẩm và dịch vụ mà chúng tôi cho là có lợi cho khách hàng;</li>
                            <li>Các chương trình khác liên quan đến nội dung trên và/hoặc cung cấp các tiện ích khác cho khách hàng thông qua các chương trình của Ladybug Pizza và các đối tác.</li>
                        </ul>
                    </div>
                </div>

                {{-- Chia sẻ thông tin --}}
                <div class="mb-4">
                    <h3 class="font-semibold text-xs md:text-sm mb-4">3. Chia sẻ thông tin:</h3>
                    <div class="text-sm ps-4 leading-loose tracking-wide">
                        <p class="mb-4">Ladybug Pizza sẽ không cung cấp thông tin cá nhân của khách hàng cho bên thứ ba không liên quan đến Ladybug Pizza và không cho phép bên thứ ba sử dụng thông tin này để tiếp thị trực tiếp đến khách hàng. Chúng tôi có thể sử dụng các công ty liên quan để vận hành và duy trì website hoặc cho các mục đích khác liên quan đến hoạt động kinh doanh, và các công ty này sẽ nhận thông tin khách hàng để thực hiện các yêu cầu của Ladybug Pizza. Chúng tôi có quyền chia sẻ thông tin cá nhân của khách hàng trong một số trường hợp khi cơ quan chính phủ có yêu cầu thông tin, phục vụ mục đích điều tra hoặc các yêu cầu khác theo quy định của pháp luật.</p>
                        <p>Thông tin cá nhân mà khách hàng đã đăng ký trên website có thể được chia sẻ với các bên thứ ba của Ladybug Pizza trong các trường hợp sau:</p>
                        <ul class="list-disc ps-4">
                            <li>Các nhà cung cấp được chúng tôi thuê để cung cấp một số dịch vụ nhất định như gửi thư đến khách hàng;</li>
                            <li>Để đáp ứng mục đích của khách hàng khi đăng ký thông tin cá nhân;</li>
                            <li>Nếu khách hàng đồng ý chia sẻ thông tin cá nhân này;</li>
                            <li>Nếu chính phủ yêu cầu chia sẻ thông tin cá nhân này;</li>
                            <li>Nếu thông tin cá nhân của khách hàng được thu thập bởi một đơn vị tiếp thị, nó sẽ được cung cấp cho đơn vị tiếp thị này để phục vụ mục đích nghiên cứu và tiếp thị.</li>
                        </ul>
                    </div>
                </div>

                {{-- Bảo mật thông tin --}}
                <div class="mb-4">
                    <h3 class="font-semibold text-xs md:text-sm mb-4">4. Bảo mật thông tin:</h3>
                    <div class="text-sm ps-4 leading-loose tracking-wide">
                        <p>Ladybug Pizza sẽ thực hiện các biện pháp an ninh để bảo vệ thông tin cá nhân của khách hàng khỏi mất mát, lạm dụng hoặc thay đổi thông tin cá nhân. Chúng tôi sử dụng các biện pháp an ninh như mã hóa thông tin cá nhân, sử dụng phần mềm bảo mật, mật khẩu để bảo vệ thông tin cá nhân của khách hàng. Chúng tôi cũng yêu cầu các nhân viên của chúng tôi tuân thủ các quy định về bảo mật thông tin cá nhân của khách hàng.</p>
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
                        <p>Ladybug Pizza có thể thu thập thông tin cá nhân từ khách hàng như đã mô tả trong phần chính sách giao hàng. Thông tin này sẽ được thu thập trong các trường hợp tương tự.</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="font-semibold text-xs md:text-sm mb-4">2. Mục đích sử dụng thông tin:</h3>
                    <div class="text-sm ps-4 leading-loose tracking-wide">
                        <p>Ladybug Pizza sẽ sử dụng thông tin cá nhân của khách hàng cho các mục đích tương tự như đã nêu trong phần chính sách giao hàng.</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="font-semibold text-xs md:text-sm mb-4">3. Chia sẻ thông tin:</h3>
                    <div class="text-sm ps-4 leading-loose tracking-wide">
                        <p>Thông tin cá nhân của khách hàng sẽ được chia sẻ theo chính sách bảo mật của Ladybug Pizza tương tự như trong chính sách giao hàng.</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="font-semibold text-xs md:text-sm mb-4">4. Bảo mật thông tin:</h3>
                    <div class="text-sm ps-4 leading-loose tracking-wide">
                        <p>Chúng tôi sẽ thực hiện các biện pháp bảo mật để bảo vệ thông tin cá nhân theo các phương pháp như đã nêu trong phần chính sách giao hàng.</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

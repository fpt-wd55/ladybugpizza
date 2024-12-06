<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi</title>
    <link href="{{ asset('favicon.svg') }}" rel="shortcut icon" type="image/x-icon">
</head>

<body style="margin: 0; padding: 0; background-color: #f5f5f5; font-family: 'Open Sans', Arial, sans-serif;">
    <table role="presentation"
        style="width: 100%; height: 100%; background-color: #f5f5f5; text-align: center; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 20px;">
                <!-- Wrapper -->
                <table role="presentation"
                    style="max-width: 800px; width: 100%; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-collapse: collapse;">
                    <!-- Header -->
                    <tr>
                        <td style="text-align: center; padding: 30px; border-bottom: 1px solid #e5e5e5;">
                            <a href="{{ route('client.home') }}" target="_blank"><img
                                    src="https://i.pinimg.com/736x/fa/8c/db/fa8cdb4f3033201dbae31a860f59e32e.jpg"
                                    alt="Ladybug Pizza" style="border-radius: 50%; width: 70px; height: 70px;"></a>
                            <a href="{{ route('client.home') }}" style="text-decoration: none" target="_blank">
                                <p style="color: #D30A0A; font-size: 22px; font-weight: bold; margin: 0">
                                    Ladybug
                                    Pizza</p>
                            </a>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px; text-align: center; border-bottom: 1px solid #e5e5e5;">
                            <h2 style="margin: 0; font-size: 18px; font-weight: bold; color: #0E9F6E;">Cảm ơn bạn đã mua
                                hàng tại Ladybug Pizza! 🍕
                            </h2>
                            <p style="margin: 15px 0 0; font-size: 16px; color: #666;; line-height: 1.5;">Xin chào
                                {{ $dataOrder->fullname }} <br>
                                Chúng tôi xin gửi lời cảm ơn chân thành vì bạn đã chọn Ladybug Pizza để thưởng thức bữa
                                ăn tuyệt vời! 🍕💖
                            </p>
                            <p style="margin: 10px 0 0; font-size: 16px; color: #666; line-height: 1.5;">
                                Chúng tôi hy vọng bạn đã có một trải nghiệm tuyệt vời và hài lòng với món ăn của mình.
                                Chúng tôi luôn cố gắng mang đến những chiếc pizza ngon nhất với chất lượng tuyệt vời và
                                dịch vụ thân thiện. Mỗi lần bạn đặt hàng, đó là một niềm vui lớn đối với chúng tôi!
                            </p>
                            <p style="margin: 10px 0 0; font-size: 16px; color: #666; line-height: 1.5;">
                                Cảm ơn bạn đã đồng hành cùng Ladybug Pizza. Chúng tôi hy vọng sẽ được phục vụ bạn thêm
                                nhiều lần nữa!
                            </p>
                            <a href="{{ route('client.product.menu') }}" target="_blank"
                                style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #D30A0A; color: #ffffff; text-decoration: none; border-radius: 4px; font-size: 16px;">Khám
                                phá thực đơn</a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="text-align: center; padding: 20px; font-size: 14px; color: #999;">
                            <p style="margin: 0;">
                                Nếu bạn cần tư vấn hoặc hỗ trợ vui lòng liên hệ qua hotline: 0382 606 012 hoặc email <a
                                    href="mailto:ladybugpizza@gmail.com" style="text-decoration:none; color:#000"
                                    target="_blank">ladybugpizza@gmail.com</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

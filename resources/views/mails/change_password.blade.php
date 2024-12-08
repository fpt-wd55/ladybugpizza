<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đổi mật khẩu thành công</title>
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
                            <h2 style="margin: 0; font-size: 18px; font-weight: bold; color: #D30A0A;">Mật khẩu của bạn
                                đã được thay đổi
                            </h2>
                            <p style="margin: 15px 0 0; font-size: 16px; color: #666;; line-height: 1.5;">Mật khẩu của
                                bạn đã được thay đổi. Nếu bạn không thực hiện hành động này, vui lòng liên hệ ngay với đội hỗ trợ khách hàng của chúng
                                tôi.
                            </p>
                            <p style="margin: 10px 0 0; font-size: 16px; color: #666; line-height: 1.5;">
                                Nếu bạn thực hiện thay đổi này, không cần thực hiện thêm bất kỳ hành động nào.
                            </p>
                            <a href="{{ route('client.contact') }}" target="_blank"
                                style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #D30A0A; color: #ffffff; text-decoration: none; border-radius: 4px; font-size: 16px;">Liên
                                hệ hỗ trợ</a>
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

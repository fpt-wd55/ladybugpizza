<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cảm ơn</title>
    <link href="{{ asset('favicon.svg') }}" rel="shortcut icon" type="image/x-icon">
</head>

<body style="margin: 0; padding: 0; background-color: #f5f5f5; font-family: 'Open Sans', Arial, sans-serif;">
    <table role="presentation"
        style="width: 100%; height: 100%; background-color: #f5f5f5; text-align: center; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 20px;">
                <table role="presentation"
                    style="max-width: 800px; width: 100%; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-collapse: collapse;">
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
                    <tr>
                        <td style="padding: 30px; text-align: center; border-bottom: 1px solid #e5e5e5;">
                            <h2 style="margin: 0; font-size: 18px; font-weight: bold; color: #0E9F6E;">Cảm ơn đã liên hệ
                                với chúng tôi
                            </h2>
                            <p style="margin: 15px 0 0; font-size: 16px; color: #666;">Xin chào
                                {{ $contactData['fullname'] }}</p>
                            <p style="margin: 10px 0 0; font-size: 16px; color: #666; line-height: 1.5;">
                                Cảm ơn bạn đã gửi thông tin đến chúng tôi. Chúng tôi đã nhận được tin nhắn với tiêu đề
                                là:
                            </p>
                            <p style="margin: 10px 0 0; font-size: 16px; color: #666; line-height: 1.5;">
                                <strong>"{{ $contactData['title'] }}"</strong>.
                            </p>
                            <p style="margin: 10px 0 0; font-size: 16px; color: #666; line-height: 1.5;">Kèm theo nội dung
                                là: {{ $contactData['message'] }}.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding: 20px; font-size: 14px; color: #999;">
                            <p style="margin: 0;">
                                Nếu bạn cần tư vấn hoặc hỗ trợ thêm vui lòng liên hệ qua email: <a
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

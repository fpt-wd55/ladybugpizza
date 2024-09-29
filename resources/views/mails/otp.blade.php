<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xác thực OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="/style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 0;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container-sec {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .otp-code {
            font-size: 24px;
            font-weight: bold;
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            border: 1px dashed #D30A0A;
            color: #FF0000;
        }

        .footer-text {
            color: #6c757d;
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }

        .welcome-section {
            background: #FF0000;
            padding: 30px;
            border-radius: 4px;
            color: #fff;
            text-align: center;
        }

        .app-name {
            font-size: 30px;
            font-weight: 800;
            margin: 7px 0px;
        }

        .verify-text {
            margin-top: 15px;
            font-size: 25px;
        }
    </style>
</head>

<body>
    <div class="container-sec">
        <div class="text-center">
            <div class="welcome-section">
                <div class="app-name">
                    Lazzybug Pizza
                </div>
            </div>
        </div>
        <p class="mt-4">Mã OTP của bạn là:</p>
        <div class="otp-code">{{ $otp }}</div>
        <p class="mt-4">Vì lý do bảo mật, mã này chỉ tồn tại trong 10 phút.</p>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

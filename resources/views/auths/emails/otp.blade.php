<?php
$otpWithSpaces = implode(' ', str_split((string)$otp));
?>
    <div class="container">
        <div class="content">
            <h1 class="title">Xác minh email của bạn để tiếp tục</h1>
            <p class="description">Mã một lần của bạn bên dưới.</p>
            <div class="otp-container">
                <p class="otp">{{$otpWithSpaces}}</p>
            </div>
            <p class="expiry">Vì lý do bảo mật, mã này sẽ hết hạn trong 10 phút.</p>
        </div>
    </div>

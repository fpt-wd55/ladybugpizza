<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\RecoveryRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserInfoRequest;
use App\Mail\Otp;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Membership;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class WebController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function register()
    {
        return view('auths.register');
    }

    public function forgotPassword()
    {
        return view('auths.forgot-password');
    }

    public function getOtp()
    {
        return view('auths.get-otp');
    }

    public function recovery()
    {
        return view('auths.recovery');
    }

    public function userInfo()
    {
        return view('auths.user-info');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {

            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        }

        return back()->with('error', 'Đăng nhập thất bại, vui lòng kiểm tra lại email hoặc mật khẩu');
    }

    public function postRegister(RegisterRequest $request)
    {
        $validated = $request->validated();
        $request->session()->put('register', $validated);

        return redirect()->route('auth.user-info');
    }

    public function postUserInfo(UserInfoRequest $request)
    {
        $validated = $request->validated();
        $register = $request->session()->get('register');
        $userData = array_merge($register, $validated);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $file->move('storage/uploads/avatars', $name);
            $userData['avatar'] = $name;
        }

        $user = User::create(array_merge($userData, [
            'username' => $this->processString($userData['fullname']),
            'role_id' => 2,
        ]));

        $addressData = [
            'user_id' => $user->id,
            'phone' => $user->phone,
            'province' => $validated['province'],
            'district' => $validated['district'],
            'ward' => $validated['ward'],
            'detail_address' => $validated['address'],
            'title' => 'Địa chỉ mặc định',
            'is_default' => 1,
        ];

        Address::create($addressData);

        // Thêm giỏ hàng mặc định cho user
        Cart::create([
            'user_id' => $user->id,
            'total' => 0,
        ]);

        // Thêm bảng member cho user
        Membership::create([
            'user_id' => $user->id,
            'points' => 0,
            'rank_id' => 1,
            'total_spent' => 0,
        ]);

        // Thêm bảng setting cho user
        UserSetting::create([
            'user_id' => $user->id,
            'email_order' => true,
            'email_promotions' => true,
            'email_security' => true,
            'push_order' => true,
            'push_promotions' => true,
            'push_security' => true,
        ]);

        return redirect()->route('auth.login')->with('success', 'Đăng ký thành công');
    }

    protected function processString($input)
    {

        $transliteration = [
            'à' => 'a',
            'á' => 'a',
            'ạ' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'ầ' => 'a',
            'ấ' => 'a',
            'ậ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'è' => 'e',
            'é' => 'e',
            'ẹ' => 'e',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ê' => 'e',
            'ề' => 'e',
            'ế' => 'e',
            'ệ' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'ị' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ò' => 'o',
            'ó' => 'o',
            'ọ' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ô' => 'o',
            'ồ' => 'o',
            'ố' => 'o',
            'ộ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'ụ' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ư' => 'u',
            'ừ' => 'u',
            'ứ' => 'u',
            'ự' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ỳ' => 'y',
            'ý' => 'y',
            'ỵ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'Đ' => 'D',
            'đ' => 'd',
        ];

        $input = strtr($input, $transliteration);

        $input = preg_replace('/[^a-zA-Z0-9]/', '', $input);

        $randomNumber = rand(1, 99);
        $processed = strtolower($input) . $randomNumber;

        return $processed;
    }

    public function postForgotPassword(ForgotPasswordRequest $request)
    {
        $request->validated();
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email không tồn tại trong hệ thống.');
        }

        Session::put('email', $request->email);

        $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        Session::put('otp', $otpCode);
        Session::put('otp_expiry', now()->addMinutes(10));
        $subject = 'Mã Xác Thực OTP';

        Mail::to($user->email)->send(new Otp($otpCode, $subject));

        return redirect()->route('auth.get-otp')->with('success', 'Mã OTP đã được gửi đến email của bạn. Vui lòng kiểm tra hộp thư và nhập mã để tiếp tục.');
    }

    public function postGetOtp(OtpRequest $request)
    {
        $otp = Session::get('otp');
        $otpExpiry = Session::get('otp_expiry');

        if ($request->otp !== $otp || now()->greaterThan($otpExpiry)) {
            return back()->withErrors(['otp' => 'OTP không chính xác hoặc đã hết hạn.']);
        }

        return redirect()->route('auth.recovery')->with('success', 'Mã OTP của bạn đã được xác nhận, vui lòng nhập mật khẩu mới');
    }

    public function postRecovery(RecoveryRequest $request)
    {
        $request->validated();

        $email = Session::get('email');
        if (!$email) {
            return back()->with('error', 'Email không được tìm thấy trong phiên này.');
        }

        $user = User::where('email', Session::get('email'))->first();
        if (!$user) {
            return back()->withErrors('error', 'Không tìm thấy người dùng trong hệ thống.');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        Session::forget(['otp', 'otp_expiry', 'email']);

        return redirect()->route('auth.login')->with('success', 'Mật khẩu đã được cập nhật thành công!');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.home')->with('success', 'Đăng xuất thành công');
    }

    public function deactivateAccount(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Mật khẩu không chính xác']);
        }
        $user->status = 2;
        $user->save();
        Auth::logout();
        return redirect('/');
    }
}

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
use App\Models\User;
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
        $credentials = $request->validated();
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
            'title' => $validated['title'],
            'is_default' => 1,
        ];

        // dd($addressData);

        // $addressNames = $this->getAddressNamesByCodes(
        //     $addressData['provinceCode'],
        //     $addressData['districtCode'],
        //     $addressData['wardCode']
        // );

        // if (is_null($addressNames['province']) || is_null($addressNames['district']) || is_null($addressNames['ward'])) {
        //     return back()->withErrors(['address' => 'Không thể tìm thấy tên cho mã địa chỉ.']);
        // }

        // $addressData['province'] = $addressNames['province'];
        // $addressData['district'] = $addressNames['district'];
        // $addressData['ward'] = $addressNames['ward'];

        // $fullAddress = implode(', ', [
        //     $addressData['detail_address'],
        //     $addressData['ward'],
        //     $addressData['district'],
        //     $addressData['province'],
        // ]);

        // [$lng, $lat] = $this->convertAddressToCoordinates($fullAddress);

        // $addressData['lng'] = $lng;
        // $addressData['lat'] = $lat;

        Address::create($addressData);

        return redirect()->route('auth.login')->with('success', 'Đăng ký thành công');
    }

    protected function processString($input)
    {

        $transliteration = [
            'à' => 'a', 'á' => 'a', 'ạ' => 'a', 'ả' => 'a', 'ã' => 'a', 'â' => 'a', 'ầ' => 'a', 'ấ' => 'a', 'ậ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a',
            'è' => 'e', 'é' => 'e', 'ẹ' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ê' => 'e', 'ề' => 'e', 'ế' => 'e', 'ệ' => 'e', 'ể' => 'e', 'ễ' => 'e',
            'ì' => 'i', 'í' => 'i', 'ị' => 'i', 'ỉ' => 'i', 'ĩ' => 'i',
            'ò' => 'o', 'ó' => 'o', 'ọ' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ô' => 'o', 'ồ' => 'o', 'ố' => 'o', 'ộ' => 'o', 'ổ' => 'o', 'ỗ' => 'o',
            'ù' => 'u', 'ú' => 'u', 'ụ' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u', 'ự' => 'u', 'ử' => 'u', 'ữ' => 'u',
            'ỳ' => 'y', 'ý' => 'y', 'ỵ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y',
            'Đ' => 'D', 'đ' => 'd',
        ];

        $input = strtr($input, $transliteration);

        $input = preg_replace('/[^a-zA-Z0-9]/', '', $input);

        $randomNumber = rand(1, 99);
        $processed = strtolower($input) . $randomNumber;

        return $processed;
    }

    private function getAddressNamesByCodes($provinceCode, $districtCode, $wardCode)
    {
        $response = file_get_contents("https://provinces.open-api.vn/api/");
        $provinces = json_decode($response, true);
        $provinceName = null;

        foreach ($provinces as $province) {
            if ($province['code'] == $provinceCode) {
                $provinceName = $province['name'];
                break;
            }
        }

        $response = file_get_contents("https://provinces.open-api.vn/api/p/{$provinceCode}?depth=2");
        $districts = json_decode($response, true);

        if (!is_array($districts)) {
            return ['province' => $provinceName, 'district' => null, 'ward' => null];
        }

        $districtName = null;

        if (isset($districts['districts']) && is_array($districts['districts'])) {
            foreach ($districts['districts'] as $district) {
                if (isset($district['code']) && $district['code'] == $districtCode) {
                    $districtName = $district['name'];
                    break;
                }
            }
        }

        $response = file_get_contents("https://provinces.open-api.vn/api/d/{$districtCode}?depth=2");
        $wards = json_decode($response, true);

        if (!is_array($wards)) {
            return ['province' => $provinceName, 'district' => $districtName, 'ward' => null];
        }

        $wardName = null;

        if (isset($wards['wards']) && is_array($wards['wards'])) {
            foreach ($wards['wards'] as $ward) {
                if (isset($ward['code']) && $ward['code'] == $wardCode) {
                    $wardName = $ward['name'];
                    break;
                }
            }
        }

        return [
            'province' => $provinceName,
            'district' => $districtName,
            'ward' => $wardName,
        ];
    }


    protected function convertAddressToCoordinates($fullAddress)
    {
        $client = new Client();
        try {
            $response = $client->get('https://nominatim.openstreetmap.org/search', [
                'query' => [
                    'q' => $fullAddress,
                    'format' => 'json',
                ],
                'headers' => [
                    'User-Agent' => 'YourAppName/1.0 (http://yourwebsite.com)',
                ],
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $data = json_decode($response->getBody(), true);

        if (isset($data[0])) {
            $location = $data[0];
            return [$location['lon'], $location['lat']];
        }

        return [null, null];
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

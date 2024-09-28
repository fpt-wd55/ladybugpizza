<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserInfoRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::attempt($credentials)) {

            return redirect()->route('client.home');
        }

        return back()->withErrors(['error' => 'Đăng nhập thất bại, vui lòng kiểm tra lại email hoặc mật khẩu']);
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

        dd(array_merge($register, $validated));

        $user = User::create(array_merge($register, $validated));

        Auth::login($user);

        return redirect()->route('client.home');
    }

    public function postForgotPassword()
    {
        return view('auths.forgot-password');
    }

    public function postGetOtp()
    {
        return view('auths.get-otp');
    }

    public function postRecovery()
    {
        return view('auths.recovery');
    }


}

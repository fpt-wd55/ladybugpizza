<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function notFound()
    {
        return view('shared.errors.404');
    }

    public function forbidden()
    {
        return view('shared.errors.403');
    }

    public function internalServerError()
    {
        return view('shared.errors.500');
    }

    public function badGateway()
    {
        return view('shared.errors.502');
    }

    public function serviceUnavailable()
    {
        return view('shared.errors.503');
    }

    public function gatewayTimeout()
    {
        return view('shared.errors.504');
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('clients.profile.index');
    }

    public function update(Request $request)
    {

    }

    public function postChangePassword(Request $request)
    {

    }

    public function membership()
    {
        return view('clients.profile.membership');
    }

    public function location()
    {
        return view('clients.profile.location');
    }

    public function settings()
    {
        return view('clients.profile.settings');
    }

    public function promotion()
    {
        return view('clients.profile.promotion');
    }

    public function updateLocation(Request $request)
    {

    }

    public function storeLocation(Request $request)
    {

    }

    public function destroyLocation(Request $request)
    {

    }
}

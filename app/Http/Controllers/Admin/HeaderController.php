<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeaderController extends Controller
{

    public static function getNotifications()
    {
        $notifications = Auth::user()->notifications->where('is_read', 0)->count();
        return compact('notifications');
    }
}

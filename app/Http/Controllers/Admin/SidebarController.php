<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public static function getPendingOrders()
    {
        $pendingOrdersCount = Order::where('order_status_id', 1)->count();
        return compact('pendingOrdersCount');
    }
}

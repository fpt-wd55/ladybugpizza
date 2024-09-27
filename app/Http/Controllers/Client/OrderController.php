<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('clients.order.index');
    }

    public function invoice()
    {
        return view('shared.invoice');
    }

    public function postCancel()
    {
        
    }

    public function rate()
    {
        return view('clients.order.rate');
    }

    public function postRate()
    {
        
    }


}

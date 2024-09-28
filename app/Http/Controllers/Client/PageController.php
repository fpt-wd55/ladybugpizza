<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function policies(){
        return view('clients.policies');
    }

    public function manual(){
        return view('clients.manual');
    }
}

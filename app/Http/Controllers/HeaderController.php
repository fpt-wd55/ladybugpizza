<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public static function getHeaderData(){
        $pages = Page::where('status',1)->get();
        return compact('pages');
    }
}

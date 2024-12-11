<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public static function getFooterData()
    {
        $pages = Page::where('status', 1)->get();
        return compact('pages');
    }
}

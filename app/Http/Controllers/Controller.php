<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function createSlug($string)
    {

        $string = strtolower($string);

        $string = $this->removeAccents($string);
    
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
    

        $string = trim($string, '-');
    
        return $string;
    }
    
    // Hàm loại bỏ dấu tiếng Việt
    public function removeAccents($string)
    {
        return preg_replace(
            array(
                '/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 
                '/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 
                '/(ì|í|ị|ỉ|ĩ)/', 
                '/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 
                '/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 
                '/(ỳ|ý|ỵ|ỷ|ỹ)/', 
                '/(đ)/',
            ), 
            array('a', 'e', 'i', 'o', 'u', 'y', 'd'), 
            $string
        );
    }
    
}

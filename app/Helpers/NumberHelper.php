<?php
namespace App\Helpers;

class NumberHelper
{

public static function convertToEnglishNumbers($input)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $input = str_replace($persian, $english, $input);
        $input = str_replace($arabic, $english, $input);

        return $input;
    }
    }

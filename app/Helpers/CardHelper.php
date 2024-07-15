<?php
namespace App\Helpers;

class CardHelper
{
    public static function isValid($cardNumber)
    {
        // الگوریتم لوهان برای اعتبارسنجی شماره کارت بانکی
        $cardNumber = preg_replace('/\D/', '', $cardNumber);
        $checksum = 0;
        $j = 1;

        for ($i = strlen($cardNumber) - 1; $i >= 0; $i--) {
            $calc = $cardNumber[$i] * $j;
            if ($calc > 9) {
                $checksum += $calc - 9;
            } else {
                $checksum += $calc;
            }
            $j = ($j == 1) ? 2 : 1;
        }

        return ($checksum % 10) == 0;
    }
}

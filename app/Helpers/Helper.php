<?php

namespace App\Helpers;

class Helper
{

    public static function getSarrsedStatus($sarrsed)
    {
        if ($sarrsed < 0) {
            return 'danger';
        } elseif ($sarrsed <= 7) {
            return 'warning';
        } else {
            return 'success';
        }
    }

    public static function ColorStateTd($state): void
    {
        if ($state == 'reserve') {
            echo "tdreserve";
        } else if ($state == 'leaving' || $state == 'nightly') {
            echo "tdleaving";
        } else {
            echo "";
        }
    }

    public static function ColorAmarTakhts($id_vahed)
    {
        if ($id_vahed == 1) {
            echo "red";
        } else if ($id_vahed == 2) {
            echo "blue";
        } else if ($id_vahed == 3) {
            echo "green";
        } else {
            echo "yellow";
        }
    }

    public static function format($phone)
    {
        // اگر شماره تلفن خالی یا null باشد
        if (empty($phone)) {
            return '';
        }

        // حذف هر چیزی به جز اعداد
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // اگر شماره تلفن 11 رقمی باشد (مثل شماره‌های ایرانی)
        if (strlen($phone) === 11) {
            return substr($phone, 0, 4) . '-' .
                substr($phone, 4, 3) . '-' .
                substr($phone, 7);
        }

        // اگر فرمت استاندارد نبود، همان شماره اصلی را برگردان
        return $phone;
    }

}

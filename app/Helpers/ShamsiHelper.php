<?php

namespace App\Helpers;

use Morilog\Jalali\Jalalian;

class ShamsiHelper
{
    /**
     * محاسبه اختلاف روزهای بین تاریخ شمسی ورودی و امروز
     */
    public static function daysDiffFromNow(string $shamsiDate): int
    {
        // پارس کردن تاریخ ورودی شمسی (مثال: "1404/2/3")
        list($year, $month, $day) = explode('/', $shamsiDate);
        
        // اعتبارسنجی تاریخ شمسی

        // ایجاد تاریخ شمسی از ورودی
        $inputDate = Jalalian::fromFormat('Y/n/j', $shamsiDate)->toCarbon()->startOfDay(); // فرمت: سال چهاررقمی/ماه بدون صفر/روز بدون صفر

        // تاریخ امروز به شمسی
        $today = Jalalian::now()->toCarbon()->startOfDay();
    
        // محاسبه اختلاف روزها (با استفاده از timestamp)
        $diffInSeconds =  $inputDate->getTimestamp() - $today->getTimestamp();
        $diffInDays = (int) floor($diffInSeconds / 86400); // 86400 ثانیه = 1 روز

        return $diffInDays;
    }

    /**
     * تبدیل تاریخ میلادی به شمسی
     */
    public static function toShamsi(\DateTime $date, string $format = 'Y/m/d'): string
    {
        return Jalalian::fromDateTime($date)->format($format);
    }
}
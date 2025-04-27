<?php

namespace App\Helpers;

class Helper
{
   
        public static function getSarrsedStatus($sarrsed) {
            if ($sarrsed < 0) {
                return 'danger';
            } elseif ($sarrsed <= 7) {
                return 'warning';
            } else {
                return 'success';
            }
        }
    
    
}
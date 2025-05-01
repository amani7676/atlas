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

        public static function ColorStateTd($state): void
        {
            if($state == 'reserve'){
                echo "tdreserve";
            }else if($state == 'leaving'){
               echo "tdleaving";
            }else  {
                echo "";
            }
        }
    
    
}
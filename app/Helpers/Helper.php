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
        
        public static function ColorAmarTakhts($id_vahed)
        {
            if($id_vahed == 1){
                echo "red";
            }else if($id_vahed == 2){
                echo "blue";
            }else if($id_vahed == 3){
                echo "green";
            }else{
                echo "yellow";
            }
        }
    
}
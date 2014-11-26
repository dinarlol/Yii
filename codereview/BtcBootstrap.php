<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RiseBootstrap
 *
 * @author mac
 */
class BtcBootstrap {
    
      public static function setDefaultTimeZone(){
         //  date_default_timezone_set('Asia/Karachi');
   
            
                $server_tz=date_default_timezone_get();
          //  date_default_timezone_set('America/New_York');
        //$curr_tz=date_default_timezone_get();
        echo 'current timezone is <br>';
        echo '<br>'.$server_tz.'<br>';
        
        echo 'date(\'Y-m-d h:i:s\') is ' . date('Y-m-d h:i:s'). '<br>';
    
            
            
            
      }
    
    
}

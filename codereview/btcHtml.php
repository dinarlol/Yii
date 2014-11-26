<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of btcHtml
 *
 * @author Zuhaib
 */
 class btcHtml {
    
     public static function getTradeTypeRadioData(){
         
         
         return array('LOCAL_SELL'=>'Selling my bitcoins locally',
                                'LOCAL_BUY'=>'Buying bitcoins locally',
                                'ONLINE_SELL'=>'Selling my bitcoins online',
                                'ONLINE_BUY'=>'Buying bitcoins online'
                                );
         
     }
    
    
    
}

<?php


class BlockChainPriceTicker
{
  
    public function save($currency = 'GBP'){
        $model = PriceTicker::model()->find("source_name=? AND currency=?",array('BlockChain',$currency));
        
        if(empty($model)){
            $model = new PriceTicker();
            $model->source_name = 'BlockChain';
        }
        //   if( Time::getDifferenceInSeconds($model->created_at, UtilityManager::getSqlCurrentDate()) > 100 || $model->isNewRecord){
        if($model->isNewRecord){
        $blockChain = UtilityManager::getCurlResponse('https://blockchain.info/ticker');
        $model->btc_bid = $blockChain->$currency->buy;
        $model->btc_ask = $blockChain->$currency->sell;
        $model->currency = $currency;
        if($model->save()){}
         
        }
       
        return $model;
   
}
}
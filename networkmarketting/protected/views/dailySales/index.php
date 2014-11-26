<?php
$this->breadcrumbs=array(
	'Sales',
);

?>

<h1>Daily Sales</h1>


<?php 
$msale ='';
$total =0;
foreach($model as $sale):
$msale = $sale;
?>


<div>
    
    <span> Joining on your <?php echo $sale->position;?> by new user: <?php echo $sale->joining_id;?> </span>
    <span><?php  $total +=  $sale->amount; echo $sale->amount;?></span>
    
</div>

<?php endforeach;?>

<span>Total Sale of last 24 hours:</span> <?php echo $total;?>
<div class ="well alert alert-error">

<?php if(!empty($msale)){
 $paid_count = UtilityManager::getUserPaidCommission($msale->user_id, $msale->stage);
 
 $rightsale = $msale->getSaleForStage($msale->stage, 'right');
 $leftsale = $msale->getSaleForStage($msale->stage, 'left');
 
 if($msale->stage == 1){
 $lr = UtilityManager::getUserLeftAndRight($msale->user_id);
 $lcommissionsmade = $lr['left'] - $paid_count;
 $rcommissionsmade = $lr['right'] - $paid_count;
 echo "<div> Total unpaid Commission: Left ".floor($lcommissionsmade)."/ Right ". floor($rcommissionsmade)." </div>";
 }
 else if($msale->stage == 2){
 $lcommissionsmade = $leftsale / UtilityManager::LEVEL_TWO_COMMISSION_BASED;
 $rcommissionsmade = $rightsale / UtilityManager::LEVEL_TWO_COMMISSION_BASED;
 echo "<div> Total unpaid Sale: Left ".floor($lcommissionsmade)."/ Right ". floor($rcommissionsmade)." </div>";
 
 }
 else if($msale->stage == 3){
 $lcommissionsmade = $leftsale / UtilityManager::LEVEL_THREE_COMMISSION_BASED;
 $rcommissionsmade = $rightsale / UtilityManager::LEVEL_THREE_COMMISSION_BASED;
 echo "<div> Total unpaid Sale: Left ".floor($lcommissionsmade)."/ Right ". floor($rcommissionsmade)." </div>";
  }
  }
?>
</div>
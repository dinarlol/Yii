<?php
$this->breadcrumbs=array(
	'Commissions',
);

?>

<h1>Daily Rewards</h1>


<?php 
$total =0;
foreach($model as $commission):
?>


<div>
    
    <span> <?php echo $commission->remarks;?></span>
    <span><?php  $total +=  $commission->points; echo $commission->points;?></span>
    
</div>

<?php endforeach;?>

<span>Total Commission for last 24 hours:</span> <?php echo $total;?>
    <?php
$this->breadcrumbs=array(
	'Commissions'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('commission-grid', {
		data: $(this).serialize()
	});
	return false;
});
");



?>

<h1>Reward Statement</h1>

<?php $reswards = UtilityManager::getUserRewardsByUserId($model->user_id);

?>

<p>
<div
    <span>Total Commission Earned:  <?php echo $reswards['commission']; ?></span>
</div>

<div
    <span>Total Commission Transfered:  <?php echo $reswards['redemption']; ?></span>
</div>

<div
    <span>Available Commission:  <?php echo $reswards['commission'] - $reswards['redemption']; ?></span>
</div>

</p>


<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'commission-grid',
    'summaryText'=>'<h4>Rewards</h4>',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'points',
		'remarks',
		'created_date',
		
	),
)); ?>

<p>
<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'redemption-grid',
    'summaryText'=>'<h4>Transfer Rewards</h4>',
	'dataProvider'=>$rmodel->search(),
	'filter'=>$rmodel,
	'columns'=>array(
		'points',
		'modified_date',
		
	),
)); ?>

</p>
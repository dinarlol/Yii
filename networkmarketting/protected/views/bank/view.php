<?php
$this->breadcrumbs=array(
	'Banks'=>array('index'),
	$model->bank_id,
);

?>

<h1>View Bank #<?php echo $model->bank_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'bank_id',
		'points',
		'reference',
		'created_date',
	),
)); ?>

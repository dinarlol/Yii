<?php
$this->breadcrumbs=array(
	'Reward Transfer'=>array('index'),
	$model->id,
);

?>

<h1>Reward Transfer #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'points',
		'modified_date',
	),
)); ?>

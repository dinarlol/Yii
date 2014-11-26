<?php
$this->breadcrumbs=array(
	'Userbanks'=>array('index'),
	$model->id,
);

?>

<h1>View Rise bank #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'reference',
		'points',
		'created_date',
		
	),
)); ?>

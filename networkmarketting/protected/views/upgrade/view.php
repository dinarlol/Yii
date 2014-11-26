<?php
$this->breadcrumbs=array(
	'Upgrades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Upgrade','url'=>array('index')),
	array('label'=>'Create Upgrade','url'=>array('create')),
	array('label'=>'Update Upgrade','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Upgrade','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Upgrade','url'=>array('admin')),
);
?>

<h1>View Upgrade #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'stage',
		'point',
		'created_date',
	),
)); ?>

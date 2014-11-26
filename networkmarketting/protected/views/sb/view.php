<?php
$this->breadcrumbs=array(
	'Sbs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Sb','url'=>array('index')),
	array('label'=>'Create Sb','url'=>array('create')),
	array('label'=>'Update Sb','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Sb','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sb','url'=>array('admin')),
);
?>

<h1>View Sb #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'point',
		'paid',
		'commissionid',
		'created_date',
		'modified_date',
	),
)); ?>

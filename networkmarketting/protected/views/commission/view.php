<?php
$this->breadcrumbs=array(
	'Commissions'=>array('index'),
	$model->commission_id,
);

$this->menu=array(
	array('label'=>'List Commission','url'=>array('index')),
	array('label'=>'Create Commission','url'=>array('create')),
	array('label'=>'Update Commission','url'=>array('update','id'=>$model->commission_id)),
	array('label'=>'Delete Commission','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->commission_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Commission','url'=>array('admin')),
);
?>

<h1>View Commission #<?php echo $model->commission_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'commission_id',
		'user_id',
		'stage',
		'points',
		'remarks',
		'created_date',
	),
)); ?>

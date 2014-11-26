<?php
$this->breadcrumbs=array(
	'Userbanks'=>array('index'),
	$model->userbank_id,
);

$this->menu=array(
	array('label'=>'List Userbank','url'=>array('index')),
	array('label'=>'Create Userbank','url'=>array('create')),
	array('label'=>'Update Userbank','url'=>array('update','id'=>$model->userbank_id)),
	array('label'=>'Delete Userbank','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->userbank_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userbank','url'=>array('admin')),
);
?>

<h1>View Userbank #<?php echo $model->userbank_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'userbank_id',
		'points',
		'transaction_type',
		'created_date',
		'total',
		'bank_id',
		'user_id',
	),
)); ?>

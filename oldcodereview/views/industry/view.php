<?php
$this->breadcrumbs=array(
	'Industries'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Industry', 'url'=>array('index')),
	array('label'=>'Create Industry', 'url'=>array('create')),
	array('label'=>'Update Industry', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Industry', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Industry', 'url'=>array('admin')),
);
?>

<h1>View Industry #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'create_date',
	),
)); ?>

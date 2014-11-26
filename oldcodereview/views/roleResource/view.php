<?php
$this->breadcrumbs=array(
	'Role Resources'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RoleResource', 'url'=>array('index')),
	array('label'=>'Create RoleResource', 'url'=>array('create')),
	array('label'=>'Update RoleResource', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RoleResource', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoleResource', 'url'=>array('admin')),
);
?>

<h1>View RoleResource #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'role_id',
		'resource_id',
		'create_date',
	),
)); ?>

<?php
$this->breadcrumbs=array(
	'User Contacts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserContact', 'url'=>array('index')),
	array('label'=>'Create UserContact', 'url'=>array('create')),
	array('label'=>'Update UserContact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserContact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserContact', 'url'=>array('admin')),
);
?>

<h1>View UserContact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'address',
		'city',
		'postal_code',
		'state',
		'phone',
		'mobile',
		'create_date',
		'modified_date',
	),
)); ?>

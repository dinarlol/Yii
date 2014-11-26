<?php
$this->breadcrumbs=array(
	'User Hobbies'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List UserHobbies', 'url'=>array('index')),
	array('label'=>'Create UserHobbies', 'url'=>array('create')),
	array('label'=>'Update UserHobbies', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserHobbies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserHobbies', 'url'=>array('admin')),
);
?>

<h1>View UserHobbies #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'name',
		'create_date',
		'modified_date',
	),
)); ?>

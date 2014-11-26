<?php
$this->breadcrumbs=array(
	'User Volunteerisms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserVolunteerism', 'url'=>array('index')),
	array('label'=>'Create UserVolunteerism', 'url'=>array('create')),
	array('label'=>'Update UserVolunteerism', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserVolunteerism', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserVolunteerism', 'url'=>array('admin')),
);
?>

<h1>View UserVolunteerism #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'organization',
		'cause',
		'start_date',
		'end_date',
		'impact',
		'create_date',
		'modified_date',
	),
)); ?>

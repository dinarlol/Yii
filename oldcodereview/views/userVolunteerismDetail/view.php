<?php
$this->breadcrumbs=array(
	'User Volunteerism Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserVolunteerismDetail', 'url'=>array('index')),
	array('label'=>'Create UserVolunteerismDetail', 'url'=>array('create')),
	array('label'=>'Update UserVolunteerismDetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserVolunteerismDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserVolunteerismDetail', 'url'=>array('admin')),
);
?>

<h1>View UserVolunteerismDetail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'volunteerism_id',
		'photo',
		'link',
		'create_date',
		'modified_date',
	),
)); ?>

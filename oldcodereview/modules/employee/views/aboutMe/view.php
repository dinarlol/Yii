<?php
$this->breadcrumbs=array(
	'User About Mes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserAboutMe', 'url'=>array('index')),
	array('label'=>'Create UserAboutMe', 'url'=>array('create')),
	array('label'=>'Update UserAboutMe', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserAboutMe', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserAboutMe', 'url'=>array('admin')),
);
?>

<h1>View UserAboutMe #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'objective',
		'create_date',
		'modified_date',
	),
)); ?>

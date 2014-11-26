<?php
$this->breadcrumbs=array(
	'User Stories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserStory', 'url'=>array('index')),
	array('label'=>'Create UserStory', 'url'=>array('create')),
	array('label'=>'Update UserStory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserStory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserStory', 'url'=>array('admin')),
);
?>

<h1>View UserStory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'story',
		'quote',
		'inspiration',
		'impact',
		'create_date',
		'modified_date',
	),
)); ?>

<?php
$this->breadcrumbs=array(
	'User Awards'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserAwards', 'url'=>array('index')),
	array('label'=>'Create UserAwards', 'url'=>array('create')),
	array('label'=>'Update UserAwards', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserAwards', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserAwards', 'url'=>array('admin')),
);
?>

<h1>View UserAwards #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'award',
		'create_date',
		'modified_date',
	),
)); ?>

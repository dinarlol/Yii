<?php
$this->breadcrumbs=array(
	'User Culinary Arts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List UserCulinaryArts', 'url'=>array('index')),
	array('label'=>'Create UserCulinaryArts', 'url'=>array('create')),
	array('label'=>'Update UserCulinaryArts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserCulinaryArts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserCulinaryArts', 'url'=>array('admin')),
);
?>

<h1>View UserCulinaryArts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'usesr_id',
		'chefs_inspired_by',
		'create_date',
		'modified_date',
		'name',
	),
)); ?>

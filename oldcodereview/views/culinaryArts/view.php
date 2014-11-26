<?php
$this->breadcrumbs=array(
	'Culinary Arts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CulinaryArts', 'url'=>array('index')),
	array('label'=>'Create CulinaryArts', 'url'=>array('create')),
	array('label'=>'Update CulinaryArts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CulinaryArts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CulinaryArts', 'url'=>array('admin')),
);
?>

<h1>View CulinaryArts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'name',
		'upload',
		'inspiredby',
	),
)); ?>

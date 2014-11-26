<?php
$this->breadcrumbs=array(
	'Music Fields'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MusicFields', 'url'=>array('index')),
	array('label'=>'Create MusicFields', 'url'=>array('create')),
	array('label'=>'Update MusicFields', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MusicFields', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MusicFields', 'url'=>array('admin')),
);
?>

<h1>View MusicFields #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'create_date',
		'modified_date',
	),
)); ?>

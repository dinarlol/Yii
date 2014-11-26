<?php
/* @var $this StageController */
/* @var $model Stage */

$this->breadcrumbs=array(
	'Stages'=>array('index'),
	$model->stage_id,
);

$this->menu=array(
	array('label'=>'List Stage', 'url'=>array('index')),
	array('label'=>'Create Stage', 'url'=>array('create')),
	array('label'=>'Update Stage', 'url'=>array('update', 'id'=>$model->stage_id)),
	array('label'=>'Delete Stage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->stage_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stage', 'url'=>array('admin')),
);
?>

<h1>View Stage #<?php echo $model->stage_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'stage_id',
		'stage',
	),
)); ?>

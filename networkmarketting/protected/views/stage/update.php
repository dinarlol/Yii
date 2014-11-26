<?php
/* @var $this StageController */
/* @var $model Stage */

$this->breadcrumbs=array(
	'Stages'=>array('index'),
	$model->stage_id=>array('view','id'=>$model->stage_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Stage', 'url'=>array('index')),
	array('label'=>'Create Stage', 'url'=>array('create')),
	array('label'=>'View Stage', 'url'=>array('view', 'id'=>$model->stage_id)),
	array('label'=>'Manage Stage', 'url'=>array('admin')),
);
?>

<h1>Update Stage <?php echo $model->stage_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
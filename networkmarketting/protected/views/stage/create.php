<?php
/* @var $this StageController */
/* @var $model Stage */

$this->breadcrumbs=array(
	'Stages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Stage', 'url'=>array('index')),
	array('label'=>'Manage Stage', 'url'=>array('admin')),
);
?>

<h1>Create Stage</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
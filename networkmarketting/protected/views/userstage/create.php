<?php
/* @var $this UserstageController */
/* @var $model Userstage */

$this->breadcrumbs=array(
	'Userstages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userstage', 'url'=>array('index')),
	array('label'=>'Manage Userstage', 'url'=>array('admin')),
);
?>

<h1>Create Userstage</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this UserEditController */
/* @var $model UserEdit */

$this->breadcrumbs=array(
	'User Edits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserEdit', 'url'=>array('index')),
	array('label'=>'Manage UserEdit', 'url'=>array('admin')),
);
?>

<h1>Create UserEdit</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
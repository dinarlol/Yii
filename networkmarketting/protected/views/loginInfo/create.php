<?php
/* @var $this LoginInfoController */
/* @var $model LoginInfo */

$this->breadcrumbs=array(
	'Login Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LoginInfo', 'url'=>array('index')),
	array('label'=>'Manage LoginInfo', 'url'=>array('admin')),
);
?>

<h1>Create LoginInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
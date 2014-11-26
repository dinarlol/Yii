<?php
/* @var $this SecurityInfoController */
/* @var $model SecurityInfo */

$this->breadcrumbs=array(
	'Security Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SecurityInfo', 'url'=>array('index')),
	array('label'=>'Manage SecurityInfo', 'url'=>array('admin')),
);
?>

<h1>Create SecurityInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
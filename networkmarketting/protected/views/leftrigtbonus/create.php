<?php
/* @var $this LeftrigtbonusController */
/* @var $model Leftrigtbonus */

$this->breadcrumbs=array(
	'Leftrigtbonuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Leftrigtbonus', 'url'=>array('index')),
	array('label'=>'Manage Leftrigtbonus', 'url'=>array('admin')),
);
?>

<h1>Create Leftrigtbonus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	$model->name=>array('index'),
	'Update',
);

$this->menu=array(
	
);
?>

<h1>Edit Contact Info</h1>

<?php 
$this->renderPartial('_form', array('model'=>$model)); 
?>
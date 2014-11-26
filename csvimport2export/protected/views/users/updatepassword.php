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

<h1>Change Password</h1>

<?php 
$this->renderPartial('password_form', array('model'=>$model)); 
?>
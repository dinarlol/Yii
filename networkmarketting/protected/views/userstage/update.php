<?php
/* @var $this UserstageController */
/* @var $model Userstage */

$this->breadcrumbs=array(
	'Userstages'=>array('index'),
	$model->userstage_id=>array('view','id'=>$model->userstage_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userstage', 'url'=>array('index')),
	array('label'=>'Create Userstage', 'url'=>array('create')),
	array('label'=>'View Userstage', 'url'=>array('view', 'id'=>$model->userstage_id)),
	array('label'=>'Manage Userstage', 'url'=>array('admin')),
);
?>

<h1>Update Userstage <?php echo $model->userstage_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
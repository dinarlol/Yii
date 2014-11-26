<?php
/* @var $this UserEditController */
/* @var $model UserEdit */

$this->breadcrumbs=array(
	'User Edits'=>array('index'),
	$model->name=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserEdit', 'url'=>array('index')),
	array('label'=>'Create UserEdit', 'url'=>array('create')),
	array('label'=>'View UserEdit', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage UserEdit', 'url'=>array('admin')),
);
?>

<h1>Update UserEdit <?php echo $model->user_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
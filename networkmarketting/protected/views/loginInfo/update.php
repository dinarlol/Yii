<?php
/* @var $this LoginInfoController */
/* @var $model LoginInfo */

$this->breadcrumbs=array(
	'Login Infos'=>array('index'),
	$model->username_id=>array('view','id'=>$model->username_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LoginInfo', 'url'=>array('index')),
	array('label'=>'Create LoginInfo', 'url'=>array('create')),
	array('label'=>'View LoginInfo', 'url'=>array('view', 'id'=>$model->username_id)),
	array('label'=>'Manage LoginInfo', 'url'=>array('admin')),
);
?>

<h1>Update LoginInfo <?php echo $model->username_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
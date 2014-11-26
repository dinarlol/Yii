<?php
/* @var $this LoginInfoController */
/* @var $model LoginInfo */

$this->breadcrumbs=array(
	'Login Infos'=>array('index'),
	$model->username_id,
);

$this->menu=array(
	array('label'=>'List LoginInfo', 'url'=>array('index')),
	array('label'=>'Create LoginInfo', 'url'=>array('create')),
	array('label'=>'Update LoginInfo', 'url'=>array('update', 'id'=>$model->username_id)),
	array('label'=>'Delete LoginInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->username_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LoginInfo', 'url'=>array('admin')),
);
?>

<h1>View LoginInfo #<?php echo $model->username_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username_id',
		'username',
		'password',
		'role_id',
	),
)); ?>

<?php
/* @var $this UserEditController */
/* @var $model UserEdit */

$this->breadcrumbs=array(
	'User Edits'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List UserEdit', 'url'=>array('index')),
	array('label'=>'Create UserEdit', 'url'=>array('create')),
	array('label'=>'Update UserEdit', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete UserEdit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserEdit', 'url'=>array('admin')),
);
?>

<h1>View UserEdit #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'date_modified',
		'user_id',
		'password',
		'name',
		'attn',
		'street',
		'city',
		'state',
		'zip',
		'tel',
		'cell',
		'email',
		'tax_id',
	),
)); ?>

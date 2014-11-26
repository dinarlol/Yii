<?php
/* @var $this UserstageController */
/* @var $model Userstage */

$this->breadcrumbs=array(
	'Userstages'=>array('index'),
	$model->userstage_id,
);

$this->menu=array(
	array('label'=>'List Userstage', 'url'=>array('index')),
	array('label'=>'Create Userstage', 'url'=>array('create')),
	array('label'=>'Update Userstage', 'url'=>array('update', 'id'=>$model->userstage_id)),
	array('label'=>'Delete Userstage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->userstage_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userstage', 'url'=>array('admin')),
);
?>

<h1>View Userstage #<?php echo $model->userstage_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'userstage_id',
		'user_id',
		'created_date',
		'modified_date',
	),
)); ?>

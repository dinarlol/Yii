<?php
/* @var $this PlanController */
/* @var $model Plan */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->plan_id,
);

$this->menu=array(
	array('label'=>'List Plan', 'url'=>array('index')),
	array('label'=>'Create Plan', 'url'=>array('create')),
	array('label'=>'Update Plan', 'url'=>array('update', 'id'=>$model->plan_id)),
	array('label'=>'Delete Plan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->plan_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Plan', 'url'=>array('admin')),
);
?>

<h1>View Plan #<?php echo $model->plan_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'plan_id',
		'plan',
	),
)); ?>

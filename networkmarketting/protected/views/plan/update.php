<?php
/* @var $this PlanController */
/* @var $model Plan */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->plan_id=>array('view','id'=>$model->plan_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Plan', 'url'=>array('index')),
	array('label'=>'Create Plan', 'url'=>array('create')),
	array('label'=>'View Plan', 'url'=>array('view', 'id'=>$model->plan_id)),
	array('label'=>'Manage Plan', 'url'=>array('admin')),
);
?>

<h1>Update Plan <?php echo $model->plan_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
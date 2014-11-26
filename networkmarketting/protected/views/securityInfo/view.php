<?php
/* @var $this SecurityInfoController */
/* @var $model SecurityInfo */

$this->breadcrumbs=array(
	'Security Infos'=>array('index'),
	$model->security_quest_id,
);

$this->menu=array(
	array('label'=>'List SecurityInfo', 'url'=>array('index')),
	array('label'=>'Create SecurityInfo', 'url'=>array('create')),
	array('label'=>'Update SecurityInfo', 'url'=>array('update', 'id'=>$model->security_quest_id)),
	array('label'=>'Delete SecurityInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->security_quest_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SecurityInfo', 'url'=>array('admin')),
);
?>

<h1>View SecurityInfo #<?php echo $model->security_quest_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'security_quest_id',
		'security_quest',
	),
)); ?>

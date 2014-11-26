<?php
/* @var $this SecurityInfoController */
/* @var $model SecurityInfo */

$this->breadcrumbs=array(
	'Security Infos'=>array('index'),
	$model->security_quest_id=>array('view','id'=>$model->security_quest_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SecurityInfo', 'url'=>array('index')),
	array('label'=>'Create SecurityInfo', 'url'=>array('create')),
	array('label'=>'View SecurityInfo', 'url'=>array('view', 'id'=>$model->security_quest_id)),
	array('label'=>'Manage SecurityInfo', 'url'=>array('admin')),
);
?>

<h1>Update SecurityInfo <?php echo $model->security_quest_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
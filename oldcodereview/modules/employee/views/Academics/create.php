<?php
$this->breadcrumbs=array(
	'User Academics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserAcademic', 'url'=>array('index')),
	array('label'=>'Manage UserAcademic', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'user_id'=>$user_id)); ?>
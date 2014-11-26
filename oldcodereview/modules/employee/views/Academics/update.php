<?php
$this->breadcrumbs=array(
	'User Academics'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserAcademic', 'url'=>array('index')),
	array('label'=>'Create UserAcademic', 'url'=>array('create')),
	array('label'=>'View UserAcademic', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage UserAcademic', 'url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model,'user_id'=>$user_id)); ?>
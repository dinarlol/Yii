<?php
$this->breadcrumbs=array(
	'User Volunteerisms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserVolunteerism', 'url'=>array('index')),
	array('label'=>'Manage UserVolunteerism', 'url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
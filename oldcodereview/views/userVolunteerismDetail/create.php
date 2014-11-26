<?php
$this->breadcrumbs=array(
	'User Volunteerism Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserVolunteerismDetail', 'url'=>array('index')),
	array('label'=>'Manage UserVolunteerismDetail', 'url'=>array('admin')),
);
?>

<h1>Create UserVolunteerismDetail</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
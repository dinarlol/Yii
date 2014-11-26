<?php
$this->breadcrumbs=array(
	'User Volunteerism Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserVolunteerismDetail', 'url'=>array('index')),
	array('label'=>'Create UserVolunteerismDetail', 'url'=>array('create')),
	array('label'=>'View UserVolunteerismDetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserVolunteerismDetail', 'url'=>array('admin')),
);
?>

<h1>Update UserVolunteerismDetail <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'User Volunteerisms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserVolunteerism', 'url'=>array('index')),
	array('label'=>'Create UserVolunteerism', 'url'=>array('create')),
	array('label'=>'View UserVolunteerism', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserVolunteerism', 'url'=>array('admin')),
);
?>

<!--<h1>Update UserVolunteerism <?php echo $model->id; ?></h1>-->
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

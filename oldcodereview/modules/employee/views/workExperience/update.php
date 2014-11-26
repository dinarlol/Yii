<?php
$this->breadcrumbs=array(
	'User Work Experiences'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserWorkExperience', 'url'=>array('index')),
	array('label'=>'Create UserWorkExperience', 'url'=>array('create')),
	array('label'=>'View UserWorkExperience', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserWorkExperience', 'url'=>array('admin')),
);
?>

<!--<h1>Update UserWorkExperience <?php echo $model->id; ?></h1>-->
<?php echo $this->renderPartial('_form', array('model'=>$model,'user_id'=>$user_id)); ?>
<?php
$this->breadcrumbs=array(
	'User Hobbies'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserHobbies', 'url'=>array('index')),
	array('label'=>'Create UserHobbies', 'url'=>array('create')),
	array('label'=>'View UserHobbies', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserHobbies', 'url'=>array('admin')),
);
?>

<h1>Update UserHobbies <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
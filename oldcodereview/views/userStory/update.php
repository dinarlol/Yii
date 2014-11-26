<?php
$this->breadcrumbs=array(
	'User Stories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserStory', 'url'=>array('index')),
	array('label'=>'Create UserStory', 'url'=>array('create')),
	array('label'=>'View UserStory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserStory', 'url'=>array('admin')),
);
?>

<h1>Update UserStory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'User Stories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserStory', 'url'=>array('index')),
	array('label'=>'Manage UserStory', 'url'=>array('admin')),
);
?>

<h1>Create UserStory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
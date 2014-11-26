<?php
$this->breadcrumbs=array(
	'Post Jobs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PostJob', 'url'=>array('index')),
	array('label'=>'Manage PostJob', 'url'=>array('admin')),
);
?>

<h1>Create PostJob</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
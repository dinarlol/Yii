<?php
$this->breadcrumbs=array(
	'Professions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Profession', 'url'=>array('index')),
	array('label'=>'Manage Profession', 'url'=>array('admin')),
);
?>

<h1>Create Profession</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
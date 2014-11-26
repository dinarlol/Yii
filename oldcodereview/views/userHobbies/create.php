<?php
$this->breadcrumbs=array(
	'User Hobbies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserHobbies', 'url'=>array('index')),
	array('label'=>'Manage UserHobbies', 'url'=>array('admin')),
);
?>

<h1>Create UserHobbies</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'User Looking Fors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserLookingFor', 'url'=>array('index')),
	array('label'=>'Manage UserLookingFor', 'url'=>array('admin')),
);
?>

<h1>Create UserLookingFor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
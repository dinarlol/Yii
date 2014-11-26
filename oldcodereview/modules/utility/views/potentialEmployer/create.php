<?php
$this->breadcrumbs=array(
	'User Potential Employers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserPotentialEmployer', 'url'=>array('index')),
	array('label'=>'Manage UserPotentialEmployer', 'url'=>array('admin')),
);
?>

<h1>Create UserPotentialEmployer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'User Potential Employers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserPotentialEmployer', 'url'=>array('index')),
	array('label'=>'Create UserPotentialEmployer', 'url'=>array('create')),
	array('label'=>'View UserPotentialEmployer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserPotentialEmployer', 'url'=>array('admin')),
);
?>

<h1>Update UserPotentialEmployer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
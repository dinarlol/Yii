<?php
$this->breadcrumbs=array(
	'User Looking Fors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserLookingFor', 'url'=>array('index')),
	array('label'=>'Create UserLookingFor', 'url'=>array('create')),
	array('label'=>'View UserLookingFor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserLookingFor', 'url'=>array('admin')),
);
?>

<h1>Update UserLookingFor <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
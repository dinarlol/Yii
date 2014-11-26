<?php
$this->breadcrumbs=array(
	'Sbs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sb','url'=>array('index')),
	array('label'=>'Create Sb','url'=>array('create')),
	array('label'=>'View Sb','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Sb','url'=>array('admin')),
);
?>

<h1>Update Sb <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Upgrades'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Upgrade','url'=>array('index')),
	array('label'=>'Create Upgrade','url'=>array('create')),
	array('label'=>'View Upgrade','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Upgrade','url'=>array('admin')),
);
?>

<h1>Update Upgrade <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
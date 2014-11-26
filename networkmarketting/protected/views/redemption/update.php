<?php
$this->breadcrumbs=array(
	'Redemptions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Redemption','url'=>array('index')),
	array('label'=>'Create Redemption','url'=>array('create')),
	array('label'=>'View Redemption','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Redemption','url'=>array('admin')),
);
?>

<h1>Update Redemption <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
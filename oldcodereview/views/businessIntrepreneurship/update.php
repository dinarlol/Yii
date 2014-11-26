<?php
$this->breadcrumbs=array(
	'Business Intrepreneurships'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BusinessIntrepreneurship', 'url'=>array('index')),
	array('label'=>'Create BusinessIntrepreneurship', 'url'=>array('create')),
	array('label'=>'View BusinessIntrepreneurship', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BusinessIntrepreneurship', 'url'=>array('admin')),
);
?>

<h1>Update BusinessIntrepreneurship <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
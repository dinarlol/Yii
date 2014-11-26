<?php
$this->breadcrumbs=array(
	'Banks'=>array('index'),
	$model->bank_id=>array('view','id'=>$model->bank_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bank','url'=>array('index')),
	array('label'=>'Create Bank','url'=>array('create')),
	array('label'=>'View Bank','url'=>array('view','id'=>$model->bank_id)),
	array('label'=>'Manage Bank','url'=>array('admin')),
);
?>

<h1>Update Bank <?php echo $model->bank_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Commissions'=>array('index'),
	$model->commission_id=>array('view','id'=>$model->commission_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Commission','url'=>array('index')),
	array('label'=>'Create Commission','url'=>array('create')),
	array('label'=>'View Commission','url'=>array('view','id'=>$model->commission_id)),
	array('label'=>'Manage Commission','url'=>array('admin')),
);
?>

<h1>Update Commission <?php echo $model->commission_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
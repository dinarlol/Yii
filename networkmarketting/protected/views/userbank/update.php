<?php
$this->breadcrumbs=array(
	'Userbanks'=>array('index'),
	$model->userbank_id=>array('view','id'=>$model->userbank_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userbank','url'=>array('index')),
	array('label'=>'Create Userbank','url'=>array('create')),
	array('label'=>'View Userbank','url'=>array('view','id'=>$model->userbank_id)),
	array('label'=>'Manage Userbank','url'=>array('admin')),
);
?>

<h1>Update Userbank <?php echo $model->userbank_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
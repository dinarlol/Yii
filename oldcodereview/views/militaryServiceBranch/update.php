<?php
$this->breadcrumbs=array(
	'Military Service Branches'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MilitaryServiceBranch', 'url'=>array('index')),
	array('label'=>'Create MilitaryServiceBranch', 'url'=>array('create')),
	array('label'=>'View MilitaryServiceBranch', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MilitaryServiceBranch', 'url'=>array('admin')),
);
?>

<h1>Update MilitaryServiceBranch <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
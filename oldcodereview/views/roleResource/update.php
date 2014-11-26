<?php
$this->breadcrumbs=array(
	'Role Resources'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoleResource', 'url'=>array('index')),
	array('label'=>'Create RoleResource', 'url'=>array('create')),
	array('label'=>'View RoleResource', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoleResource', 'url'=>array('admin')),
);
?>

<h1>Update RoleResource <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
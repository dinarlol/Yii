<?php
$this->breadcrumbs=array(
	'Role Resources'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoleResource', 'url'=>array('index')),
	array('label'=>'Manage RoleResource', 'url'=>array('admin')),
);
?>

<h1>Create RoleResource</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
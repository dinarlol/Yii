<?php
$this->breadcrumbs=array(
	'Sbs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sb','url'=>array('index')),
	array('label'=>'Manage Sb','url'=>array('admin')),
);
?>

<h1>Create Sb</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Transfers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Transfer','url'=>array('index')),
	array('label'=>'Manage Transfer','url'=>array('admin')),
);
?>

<h1>Create Transfer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
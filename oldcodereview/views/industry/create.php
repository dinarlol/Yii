<?php
$this->breadcrumbs=array(
	'Industries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Industry', 'url'=>array('index')),
	array('label'=>'Manage Industry', 'url'=>array('admin')),
);
?>

<h1>Create Industry</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
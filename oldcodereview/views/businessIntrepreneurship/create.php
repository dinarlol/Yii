<?php
$this->breadcrumbs=array(
	'Business Intrepreneurships'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BusinessIntrepreneurship', 'url'=>array('index')),
	array('label'=>'Manage BusinessIntrepreneurship', 'url'=>array('admin')),
);
?>

<h1>Create BusinessIntrepreneurship</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
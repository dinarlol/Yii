<?php
$this->breadcrumbs=array(
	'Register',
);

$this->menu=array(
	array('label'=>'List Person', 'url'=>array('index')),
	array('label'=>'Manage Person', 'url'=>array('admin')),
);
?>

<h1>Create Person</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
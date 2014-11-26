<?php
$this->breadcrumbs=array(
	'Music Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MusicFields', 'url'=>array('index')),
	array('label'=>'Manage MusicFields', 'url'=>array('admin')),
);
?>

<h1>Create MusicFields</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
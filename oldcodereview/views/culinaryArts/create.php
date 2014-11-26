<?php
$this->breadcrumbs=array(
	'Culinary Arts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CulinaryArts', 'url'=>array('index')),
	array('label'=>'Manage CulinaryArts', 'url'=>array('admin')),
);
?>

<h1>Create CulinaryArts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
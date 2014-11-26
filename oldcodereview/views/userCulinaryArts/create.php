<?php
$this->breadcrumbs=array(
	'User Culinary Arts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserCulinaryArts', 'url'=>array('index')),
	array('label'=>'Manage UserCulinaryArts', 'url'=>array('admin')),
);
?>

<h1>Create UserCulinaryArts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
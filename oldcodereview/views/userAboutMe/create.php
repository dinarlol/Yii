<?php
$this->breadcrumbs=array(
	'User About Mes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserAboutMe', 'url'=>array('index')),
	array('label'=>'Manage UserAboutMe', 'url'=>array('admin')),
);
?>

<h1>Create UserAboutMe</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
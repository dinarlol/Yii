<?php
$this->breadcrumbs=array(
	'User Recomendations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserRecomendations', 'url'=>array('index')),
	array('label'=>'Manage UserRecomendations', 'url'=>array('admin')),
);
?>

<h1>Create UserRecomendations</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'nuggets'=>$nuggets)); ?>
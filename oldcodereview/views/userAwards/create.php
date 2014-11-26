<?php
$this->breadcrumbs=array(
	'User Awards'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserAwards', 'url'=>array('index')),
	array('label'=>'Manage UserAwards', 'url'=>array('admin')),
);
?>

<h1>Create UserAwards</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
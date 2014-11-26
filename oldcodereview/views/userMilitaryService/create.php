<?php
$this->breadcrumbs=array(
	'User Military Services'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserMilitaryService', 'url'=>array('index')),
	array('label'=>'Manage UserMilitaryService', 'url'=>array('admin')),
);
?>

<h1>Create UserMilitaryService</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
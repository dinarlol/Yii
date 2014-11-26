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
<?php echo $this->renderPartial('_form', array('model'=>$model,'user_id'=>$user_id)); ?>
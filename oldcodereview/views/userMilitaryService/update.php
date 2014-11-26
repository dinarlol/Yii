<?php
$this->breadcrumbs=array(
	'User Military Services'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserMilitaryService', 'url'=>array('index')),
	array('label'=>'Create UserMilitaryService', 'url'=>array('create')),
	array('label'=>'View UserMilitaryService', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserMilitaryService', 'url'=>array('admin')),
);
?>

<h1>Update UserMilitaryService <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
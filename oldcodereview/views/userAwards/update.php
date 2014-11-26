<?php
$this->breadcrumbs=array(
	'User Awards'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserAwards', 'url'=>array('index')),
	array('label'=>'Create UserAwards', 'url'=>array('create')),
	array('label'=>'View UserAwards', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserAwards', 'url'=>array('admin')),
);
?>

<h1>Update UserAwards <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
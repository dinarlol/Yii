<?php
$this->breadcrumbs=array(
	'User Culinary Arts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserCulinaryArts', 'url'=>array('index')),
	array('label'=>'Create UserCulinaryArts', 'url'=>array('create')),
	array('label'=>'View UserCulinaryArts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserCulinaryArts', 'url'=>array('admin')),
);
?>

<h1>Update UserCulinaryArts <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
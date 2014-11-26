<?php
$this->breadcrumbs=array(
	'User Contacts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserContact', 'url'=>array('index')),
	array('label'=>'Create UserContact', 'url'=>array('create')),
	array('label'=>'View UserContact', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserContact', 'url'=>array('admin')),
);
?>

<h1>Update UserContact <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
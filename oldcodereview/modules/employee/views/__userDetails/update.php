<?php
$this->breadcrumbs=array(
	'User Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserDetails', 'url'=>array('index')),
	array('label'=>'Create UserDetails', 'url'=>array('create')),
	array('label'=>'View UserDetails', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserDetails', 'url'=>array('admin')),
);
?>

<h1>Update UserDetails <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Music Fields'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MusicFields', 'url'=>array('index')),
	array('label'=>'Create MusicFields', 'url'=>array('create')),
	array('label'=>'View MusicFields', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MusicFields', 'url'=>array('admin')),
);
?>

<h1>Update MusicFields <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
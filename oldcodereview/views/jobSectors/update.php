<?php
$this->breadcrumbs=array(
	'Job Sectors'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JobSectors', 'url'=>array('index')),
	array('label'=>'Create JobSectors', 'url'=>array('create')),
	array('label'=>'View JobSectors', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JobSectors', 'url'=>array('admin')),
);
?>

<h1>Update JobSectors <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
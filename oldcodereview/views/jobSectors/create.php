<?php
$this->breadcrumbs=array(
	'Job Sectors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JobSectors', 'url'=>array('index')),
	array('label'=>'Manage JobSectors', 'url'=>array('admin')),
);
?>

<h1>Create JobSectors</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
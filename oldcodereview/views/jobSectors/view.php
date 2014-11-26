<?php
$this->breadcrumbs=array(
	'Job Sectors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List JobSectors', 'url'=>array('index')),
	array('label'=>'Create JobSectors', 'url'=>array('create')),
	array('label'=>'Update JobSectors', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JobSectors', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JobSectors', 'url'=>array('admin')),
);
?>

<h1>View JobSectors #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'create_date',
		'modified_date',
	),
)); ?>

<?php
$this->breadcrumbs=array(
	'Company Ranges'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CompanyRanges', 'url'=>array('index')),
	array('label'=>'Create CompanyRanges', 'url'=>array('create')),
	array('label'=>'Update CompanyRanges', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompanyRanges', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompanyRanges', 'url'=>array('admin')),
);
?>

<h1>View CompanyRanges #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'from',
		'to',
		'create_date',
	),
)); ?>

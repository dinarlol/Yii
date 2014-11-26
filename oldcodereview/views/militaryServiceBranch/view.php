<?php
$this->breadcrumbs=array(
	'Military Service Branches'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MilitaryServiceBranch', 'url'=>array('index')),
	array('label'=>'Create MilitaryServiceBranch', 'url'=>array('create')),
	array('label'=>'Update MilitaryServiceBranch', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MilitaryServiceBranch', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MilitaryServiceBranch', 'url'=>array('admin')),
);
?>

<h1>View MilitaryServiceBranch #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'create_date',
		'modified_date',
	),
)); ?>

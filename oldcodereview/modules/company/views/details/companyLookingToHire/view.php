<?php
$this->breadcrumbs=array(
	'Company Looking To Hires'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CompanyLookingToHire', 'url'=>array('index')),
	array('label'=>'Create CompanyLookingToHire', 'url'=>array('create')),
	array('label'=>'Update CompanyLookingToHire', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompanyLookingToHire', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompanyLookingToHire', 'url'=>array('admin')),
);
?>

<h1>View CompanyLookingToHire #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'looking_to_hire',
		'company_id',
	),
)); ?>

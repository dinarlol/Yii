<?php
$this->breadcrumbs=array(
	'Company Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CompanyDetail', 'url'=>array('index')),
	array('label'=>'Create CompanyDetail', 'url'=>array('create')),
	array('label'=>'Update CompanyDetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompanyDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompanyDetail', 'url'=>array('admin')),
);
?>

<h1>View CompanyDetail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_id',
		'company_info',
		'description',
		'website_url',
		'email',
		'phone',
		'country',
		'city',
		'state',
		'street',
		'zip',
		'create_date',
		'modified_date',
		
	),
)); ?>

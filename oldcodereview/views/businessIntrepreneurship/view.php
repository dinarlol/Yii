<?php
$this->breadcrumbs=array(
	'Business Intrepreneurships'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BusinessIntrepreneurship', 'url'=>array('index')),
	array('label'=>'Create BusinessIntrepreneurship', 'url'=>array('create')),
	array('label'=>'Update BusinessIntrepreneurship', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BusinessIntrepreneurship', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BusinessIntrepreneurship', 'url'=>array('admin')),
);
?>

<h1>View BusinessIntrepreneurship #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'upload_work',
		'relevant_business_projects',
		'create_date',
		'modified_date',
		'ventures',
		'link',
		'inspiredby',
	),
)); ?>

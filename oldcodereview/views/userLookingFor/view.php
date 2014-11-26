<?php
$this->breadcrumbs=array(
	'User Looking Fors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserLookingFor', 'url'=>array('index')),
	array('label'=>'Create UserLookingFor', 'url'=>array('create')),
	array('label'=>'Update UserLookingFor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserLookingFor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserLookingFor', 'url'=>array('admin')),
);
?>

<h1>View UserLookingFor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'industry_id',
		'profession_id',
		'create_date',
		'modified_date',
	),
)); ?>

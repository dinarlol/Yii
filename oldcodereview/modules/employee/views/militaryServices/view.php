<?php
$this->breadcrumbs=array(
	'User Military Services'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserMilitaryService', 'url'=>array('index')),
	array('label'=>'Create UserMilitaryService', 'url'=>array('create')),
	array('label'=>'Update UserMilitaryService', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserMilitaryService', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserMilitaryService', 'url'=>array('admin')),
);
?>

<h1>View UserMilitaryService #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'branch_id',
		'devision',
		'rank',
		'create_date',
		'modified_date',
	),
)); ?>

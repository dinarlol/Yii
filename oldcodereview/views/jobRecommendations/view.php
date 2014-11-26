<?php
$this->breadcrumbs=array(
	'Job Recommendations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JobRecommendations', 'url'=>array('index')),
	array('label'=>'Create JobRecommendations', 'url'=>array('create')),
	array('label'=>'Update JobRecommendations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JobRecommendations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JobRecommendations', 'url'=>array('admin')),
);
?>

<h1>View JobRecommendations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_id',
		'user_group_id',
		'job_id',
		'recommender_id',
		'user_id',
		'comments',
		'show',
		'recommender_name',
		'recommender_current_position',
		'recommender_email',
		'create_date',
		'modified_date',
	),
)); ?>

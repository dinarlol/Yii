<?php
$this->breadcrumbs=array(
	'Job Recommendations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List JobRecommendations', 'url'=>array('index')),
	array('label'=>'Create JobRecommendations', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('job-recommendations-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Job Recommendations</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-recommendations-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'company_id',
		'user_group_id',
		'job_id',
		'recommender_id',
		'user_id',
		/*
		'comments',
		'show',
		'recommender_name',
		'recommender_current_position',
		'recommender_email',
		'create_date',
		'modified_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

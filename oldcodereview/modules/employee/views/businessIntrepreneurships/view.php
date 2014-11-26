

<h1>View UserScienceTechnology #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'relevant_business_projects',
		'inspiredby',
		'create_date',
		'modified_date',
	),
)); ?>

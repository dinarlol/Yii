

<h1>View UserScienceTechnology #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'field_of_study',
		'inspiredby',
		'create_date',
		'modified_date',
	),
)); ?>

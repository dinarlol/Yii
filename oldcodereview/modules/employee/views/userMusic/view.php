
<h1>View UserMusic #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'inspired_by',
		'create_date',
		'modified_date',
	),
)); ?>

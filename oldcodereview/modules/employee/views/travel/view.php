<div class="nugget_edit">

<h1>View Travel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'destination_id',
		'create_date',
		'modified_date',
	),
)); ?>


<div class="fix"></div>
            </div>
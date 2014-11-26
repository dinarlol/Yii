<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_id,
);
?>


<h1>User #<?php echo $model->user_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'full_name',
		'cnic',
		'dob',
		'primary_email',
		'mobile',
		'address',
		'created_date',
		
	),
)); ?>

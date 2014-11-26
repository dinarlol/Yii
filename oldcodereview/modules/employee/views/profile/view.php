<?php
$this->breadcrumbs=array(
	'Profile'=>array('profile/'),
	$model->first_name,
);
$this->menu=array(
		array('label'=>'Edit Details', 'url'=>array('update', 'id'=>$model->user_id)),
		
);
?>
<h1>View UserDetails #<?php echo $model->first_name; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'first_name', 'last_name', 	'dob',	'country',	'city',	'state',	'street',	'zip',
		'phone',
		'create_date',
		
	),
)); 




?>

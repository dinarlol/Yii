<?php
$this->breadcrumbs=array(
	'Persons'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Person', 'url'=>array('index')),
	array('label'=>'Create Person', 'url'=>array('create')),
	array('label'=>'Update Person', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Person', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Person', 'url'=>array('admin')),
);
?>

<h1>View Person #<?php echo $model->id; ?></h1>

<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'userDetails.first_name:$data->usserDetails->first_name',
			'userDetails.last_name',
			'userDetails.email',
			'userDetails.country',
			'userDetails.city',
			'userDetails.dob',
			'id',
		'group_id',
		'role_id',
		'email',
		'password',
		'status',
		'lng',
		'lat',
		'create_date',
		'modified_date',
	),
		array(
				'name' => 'userDetails.last_name',
				'value' =>$model->userDetails[0]->last_name,
		),
)); 
*/



$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'userDetails.first_name',             // title attribute (in plain text)
				'userDetails.last_name',        // an attribute of the related object "owner"
				'email:html',  // description attribute in HTML
				'userDetails.dob',
				'userDetails.city',
				'userDetails.state',
				'userDetails.country',
				'userDetails.zip',
				
		),
		
		
		
		
		
));





?>

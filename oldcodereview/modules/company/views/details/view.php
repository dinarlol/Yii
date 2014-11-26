<?php
$this->breadcrumbs=array(
	'Companys'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Update Company', 'url'=>array('update', 'id'=>$model->user_id)),

);
?>

<h1>View Company #<?php echo $model->name; ?></h1>

<?php 

$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'name',
				'create_date',
				array(
						'label'=>'Company info',
                        'type'=>'raw',
						'value'=>(!empty($model->companyDetails->company_info)) ? CHtml::encode($model->companyDetails->company_info) : 'N/A',                        
						
				),
				array(
						'label'=>'Description',
						'type'=>'raw',
						'value'=>(!empty($model->companyDetails->description)) ? CHtml::encode($model->companyDetails->description) : 'N/A',
				
				),
				array(
						'label'=>'Website Url',
						'type'=>'raw',
						'value'=>(!empty($model->companyDetails->website_url)) ? CHtml::encode($model->companyDetails->website_url) : 'N/A',
				
				),
				array(
						'label'=>'Phone',
						'type'=>'raw',
						'value'=>(!empty($model->companyDetails->phone)) ? CHtml::encode($model->companyDetails->phone) : 'N/A',
				
				),
				array(
						'label'=>'Street Address',
						'type'=>'raw',
						'value'=>(!empty($model->companyDetails->street)) ? CHtml::encode($model->companyDetails->street) : 'N/A',
				
				),array(
						'label'=>'Country',
						'type'=>'raw',
						'value'=>(!empty($model->companyDetails->country)) ? CHtml::encode($model->companyDetails->country) : 'N/A',
				
				),
				array(
						'label'=>'City',
						'type'=>'raw',
						'value'=>(!empty($model->companyDetails->city)) ? CHtml::encode($model->companyDetails->city) : 'N/A',
				
				),
				array(
						'label'=>'Zip',
						'type'=>'raw',
						'value'=>(!empty($model->companyDetails->zip)) ? CHtml::encode($model->companyDetails->zip) : 'N/A',
				
				),
		),
));





?>

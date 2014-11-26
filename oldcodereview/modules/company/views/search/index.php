<?php


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('company-detail-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Companies</h1>

</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'company-detail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'company_id',
		'company_info',
		'description',
		'website_url',
		'email',
		/*
		'phone',
		'country',
		'city',
		'state',
		'street',
		'zip',
		'create_date',
		'modified_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

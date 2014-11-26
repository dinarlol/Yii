
<?php
$this->breadcrumbs=array(

	'Sbs'=>array('index'),

	'Saving Bank',

);






Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('sb-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1>Savings Bank</h1>





<?php $this->widget('bootstrap.widgets.TbGridView',array(

	'id'=>'sb-grid',

	'dataProvider'=>$model->search(),

	'filter'=>$model,

	'columns'=>array(

		'point',
		'paid',
		'created_date',
		/*
		'modified_date',
		*/

		array(

			'class'=>'bootstrap.widgets.TbButtonColumn',

		),

	),

)); ?>


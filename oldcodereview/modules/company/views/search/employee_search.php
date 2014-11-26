<?php
$this->breadcrumbs=array(
	'User Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserDetails', 'url'=>array('index')),
	array('label'=>'Create UserDetails', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiListView.update('user-details-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Employee</h1>



<div class="search-form" >
<?php $this->renderPartial('_employeesearch',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 



$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-details-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'first_name',
		'last_name',
		'country',
		/*
		'city',
		'state',
		'street',
		'zip',
		'phone',
		'create_date',
		'modified_date',
		*/

		array(
			'class'=>'CButtonColumn',
				'template' => '{view}',
		),
	),
)); 


?>

<?php

 /*
 
 
 $this->widget('zii.widgets.CListView', array(
 		'id'=>'user-details-grid',
		//'ajaxUpdate'=>true,
 		//'template'=>'{sorter}<br />{summary}{items}{pager}',
		'pager'=>array('pageSize' =>1), 
 		//'emptyText'=>'No Result Found',
 		'enablePagination'=>true,
 		//'summaryText'=>' From{start} End {end} Total {count} nums <br/> page {page} pages {pages} found',
 		'dataProvider'=>$model->search(),
        'itemView'=>'_view',
 		'htmlOptions'=>array('class'=>'tab_container'),
       'id'=>'user-details-grid',             //must have id corresponding to js above
       'sortableAttributes'=>array(
        'first_name',
		'last_name',
		'country',
    ),
)); 

*/

?>



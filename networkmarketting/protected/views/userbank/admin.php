<?php
$this->breadcrumbs=array(
	'Rise bank'=>array('index'),
	
);


?>

<h1>Rise bank Statement</h1>



<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'userbank-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'userb    ank_id',
		'points',
		'transaction_type',
		'created_date',
		'total',
		/*'bank_id',
		/*
		'user_id',
		*/
		
	),
)); ?>

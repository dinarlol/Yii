<?php
$this->breadcrumbs=array(
	'Transfers',
);

$this->menu=array(
	array('label'=>'Create Transfer','url'=>array('create')),
	array('label'=>'Manage Transfer','url'=>array('admin')),
);
?>

<h1>Transfers</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

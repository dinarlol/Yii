<?php
$this->breadcrumbs=array(
	'Sbs',
);

$this->menu=array(
	array('label'=>'Create Sb','url'=>array('create')),
	array('label'=>'Manage Sb','url'=>array('admin')),
);
?>

<h1>Sbs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

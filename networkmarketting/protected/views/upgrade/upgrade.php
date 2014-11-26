<?php
$this->breadcrumbs=array(
	'Upgrades',
);

$this->menu=array(
	array('label'=>'Create Upgrade','url'=>array('create')),
	array('label'=>'Manage Upgrade','url'=>array('admin')),
);
?>

<h1>Upgrades</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

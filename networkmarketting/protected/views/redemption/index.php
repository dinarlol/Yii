<?php
$this->breadcrumbs=array(
	'Redemptions',
);

$this->menu=array(
	array('label'=>'Create Redemption','url'=>array('create')),
	array('label'=>'Manage Redemption','url'=>array('admin')),
);
?>

<h1>Redemptions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

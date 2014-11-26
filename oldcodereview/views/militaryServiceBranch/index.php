<?php
$this->breadcrumbs=array(
	'Military Service Branches',
);

$this->menu=array(
	array('label'=>'Create MilitaryServiceBranch', 'url'=>array('create')),
	array('label'=>'Manage MilitaryServiceBranch', 'url'=>array('admin')),
);
?>

<h1>Military Service Branches</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

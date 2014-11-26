<?php
$this->breadcrumbs=array(
	'Role Resources',
);

$this->menu=array(
	array('label'=>'Create RoleResource', 'url'=>array('create')),
	array('label'=>'Manage RoleResource', 'url'=>array('admin')),
);
?>

<h1>Role Resources</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

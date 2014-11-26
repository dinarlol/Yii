<?php
$this->breadcrumbs=array(
	'User Contacts',
);

$this->menu=array(
	array('label'=>'Create UserContact', 'url'=>array('create')),
	array('label'=>'Manage UserContact', 'url'=>array('admin')),
);
?>

<h1>User Contacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

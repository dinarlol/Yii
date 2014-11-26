<?php
$this->breadcrumbs=array(
	'User Military Services',
);

$this->menu=array(
	array('label'=>'Create UserMilitaryService', 'url'=>array('create')),
	array('label'=>'Manage UserMilitaryService', 'url'=>array('admin')),
);
?>

<h1>User Military Services</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

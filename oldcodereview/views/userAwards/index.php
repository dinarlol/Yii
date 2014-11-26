<?php
$this->breadcrumbs=array(
	'User Awards',
);

$this->menu=array(
	array('label'=>'Create UserAwards', 'url'=>array('create')),
	array('label'=>'Manage UserAwards', 'url'=>array('admin')),
);
?>

<h1>User Awards</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'User Culinary Arts',
);

$this->menu=array(
	array('label'=>'Create UserCulinaryArts', 'url'=>array('create')),
	array('label'=>'Manage UserCulinaryArts', 'url'=>array('admin')),
);
?>

<h1>User Culinary Arts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

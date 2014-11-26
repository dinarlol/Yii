<?php
$this->breadcrumbs=array(
	'User Looking Fors',
);

$this->menu=array(
	array('label'=>'Create UserLookingFor', 'url'=>array('create')),
	array('label'=>'Manage UserLookingFor', 'url'=>array('admin')),
);
?>

<h1>User Looking Fors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

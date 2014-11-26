<?php
$this->breadcrumbs=array(
	'User Hobbies',
);

$this->menu=array(
	array('label'=>'Create UserHobbies', 'url'=>array('create')),
	array('label'=>'Manage UserHobbies', 'url'=>array('admin')),
);
?>

<h1>User Hobbies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

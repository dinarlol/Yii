<?php
$this->breadcrumbs=array(
	'User Stories',
);

$this->menu=array(
	array('label'=>'Create UserStory', 'url'=>array('create')),
	array('label'=>'Manage UserStory', 'url'=>array('admin')),
);
?>

<h1>User Stories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

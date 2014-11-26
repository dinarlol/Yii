<?php
$this->breadcrumbs=array(
	'User Volunteerism Details',
);

$this->menu=array(
	array('label'=>'Create UserVolunteerismDetail', 'url'=>array('create')),
	array('label'=>'Manage UserVolunteerismDetail', 'url'=>array('admin')),
);
?>

<h1>User Volunteerism Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

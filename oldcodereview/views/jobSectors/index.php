<?php
$this->breadcrumbs=array(
	'Job Sectors',
);

$this->menu=array(
	array('label'=>'Create JobSectors', 'url'=>array('create')),
	array('label'=>'Manage JobSectors', 'url'=>array('admin')),
);
?>

<h1>Job Sectors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Job Recommendations',
);

$this->menu=array(
	array('label'=>'Create JobRecommendations', 'url'=>array('create')),
	array('label'=>'Manage JobRecommendations', 'url'=>array('admin')),
);
?>

<h1>Job Recommendations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Job Recommendations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JobRecommendations', 'url'=>array('index')),
	array('label'=>'Manage JobRecommendations', 'url'=>array('admin')),
);
?>

<h1>Create JobRecommendations</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
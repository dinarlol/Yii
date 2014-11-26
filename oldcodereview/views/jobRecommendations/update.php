<?php
$this->breadcrumbs=array(
	'Job Recommendations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JobRecommendations', 'url'=>array('index')),
	array('label'=>'Create JobRecommendations', 'url'=>array('create')),
	array('label'=>'View JobRecommendations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JobRecommendations', 'url'=>array('admin')),
);
?>

<h1>Update JobRecommendations <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Post Jobs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PostJob', 'url'=>array('index')),
	array('label'=>'Create PostJob', 'url'=>array('create')),
	array('label'=>'View PostJob', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PostJob', 'url'=>array('admin')),
);
?>

<h1>Update PostJob <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
                            'postJobModel'=>$postJobLoc,
                            'postJobRequirement'=>$postJobReq, 
                            'postJobRequirementOpt'=>$postJobReqOpt)); ?>
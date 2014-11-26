<?php
$this->breadcrumbs=array(
	'User About Mes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserAboutMe', 'url'=>array('index')),
	array('label'=>'Create UserAboutMe', 'url'=>array('create')),
	array('label'=>'View UserAboutMe', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserAboutMe', 'url'=>array('admin')),
);
?>

<!--<h1>Update UserAboutMe <?php echo $model->id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model,'user_id'=>$user_id,'interestVal'=>$interestVal,
            'userLookingForVal'=>$userLookingForVal)); ?>
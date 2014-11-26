<?php
$this->breadcrumbs=array(
	'Personal Info'=>array('index'),
	$model->first_name=>array('view','id'=>$model->user_id),
	'Update',
);


?>

<h1>Update UserDetails <?php echo $model->first_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
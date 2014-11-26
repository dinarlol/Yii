<?php
$this->breadcrumbs=array(
	'Companys'=>array('index'),
	$model->name=>array('view','id'=>$model->user_id),
	'Update',
);


?>

<h1>Update Company <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
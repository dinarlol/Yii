<?php
$this->breadcrumbs=array(
	'Company Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompanyDetail', 'url'=>array('index')),
	array('label'=>'Create CompanyDetail', 'url'=>array('create')),
	array('label'=>'View CompanyDetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompanyDetail', 'url'=>array('admin')),
);
?>

<h1>Update CompanyDetail <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
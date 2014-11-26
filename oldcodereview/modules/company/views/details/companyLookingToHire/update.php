<?php
$this->breadcrumbs=array(
	'Company Looking To Hires'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompanyLookingToHire', 'url'=>array('index')),
	array('label'=>'Create CompanyLookingToHire', 'url'=>array('create')),
	array('label'=>'View CompanyLookingToHire', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompanyLookingToHire', 'url'=>array('admin')),
);
?>

<h1>Update CompanyLookingToHire <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
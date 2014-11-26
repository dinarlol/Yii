<?php
$this->breadcrumbs=array(
	'Company Looking To Hires'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompanyLookingToHire', 'url'=>array('index')),
	array('label'=>'Manage CompanyLookingToHire', 'url'=>array('admin')),
);
?>

<h1>Create CompanyLookingToHire</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
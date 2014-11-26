<?php
$this->breadcrumbs=array(
	'Company Ranges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompanyRanges', 'url'=>array('index')),
	array('label'=>'Manage CompanyRanges', 'url'=>array('admin')),
);
?>

<h1>Create CompanyRanges</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
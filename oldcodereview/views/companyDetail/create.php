<?php
$this->breadcrumbs=array(
	'Company Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompanyDetail', 'url'=>array('index')),
	array('label'=>'Manage CompanyDetail', 'url'=>array('admin')),
);
?>

<h1>Create CompanyDetail</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
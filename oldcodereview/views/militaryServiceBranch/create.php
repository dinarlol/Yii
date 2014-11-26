<?php
$this->breadcrumbs=array(
	'Military Service Branches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MilitaryServiceBranch', 'url'=>array('index')),
	array('label'=>'Manage MilitaryServiceBranch', 'url'=>array('admin')),
);
?>

<h1>Create MilitaryServiceBranch</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'User Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserContact', 'url'=>array('index')),
	array('label'=>'Manage UserContact', 'url'=>array('admin')),
);
?>

<h1>Create UserContact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'User Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserDetails', 'url'=>array('index')),
	array('label'=>'Manage UserDetails', 'url'=>array('admin')),
);
?>

<h1>Create UserDetails</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
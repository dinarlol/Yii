<?php
$this->breadcrumbs=array(
	'Userbanks'=>array('index'),
	'Create',
);

?>

<h1>Rise bank</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
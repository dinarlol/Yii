<?php
$this->breadcrumbs=array(
	'Banks'=>array('index'),
	'Create',
);

?>

<h1>Create Bank</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
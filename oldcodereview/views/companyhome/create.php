<?php
$this->breadcrumbs=array(
	'Companys'=>array('index'),
	'Register Company',
);


?>

<h1>Register Company</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'loginmodel'=>$loginmodel,'reqparams'=>$reqparams)); ?>
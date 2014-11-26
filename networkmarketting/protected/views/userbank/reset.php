<?php
$this->breadcrumbs=array(
	'Userbanks'=>array('index'),
	'Reset',
);

?>

<h1>Reset <?php echo $name ?></h1>

<?php echo $this->renderPartial('_reset', array('model'=>$model,"name"=>$name)); ?>
    <?php
$this->breadcrumbs=array(
	'Rewards'=>array('index'),
	'Transfer',
);

?>

<h1>Transfer Rewards</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
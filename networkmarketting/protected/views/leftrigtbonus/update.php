<?php
/* @var $this LeftrigtbonusController */
/* @var $model Leftrigtbonus */

$this->breadcrumbs=array(
	'Leftrigtbonuses'=>array('index'),
	$model->bonus_id=>array('view','id'=>$model->bonus_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Leftrigtbonus', 'url'=>array('index')),
	array('label'=>'Create Leftrigtbonus', 'url'=>array('create')),
	array('label'=>'View Leftrigtbonus', 'url'=>array('view', 'id'=>$model->bonus_id)),
	array('label'=>'Manage Leftrigtbonus', 'url'=>array('admin')),
);
?>

<h1>Update Leftrigtbonus <?php echo $model->bonus_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
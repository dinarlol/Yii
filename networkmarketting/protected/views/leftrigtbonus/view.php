<?php
/* @var $this LeftrigtbonusController */
/* @var $model Leftrigtbonus */

$this->breadcrumbs=array(
	'Leftrigtbonuses'=>array('index'),
	$model->bonus_id,
);

$this->menu=array(
	array('label'=>'List Leftrigtbonus', 'url'=>array('index')),
	array('label'=>'Create Leftrigtbonus', 'url'=>array('create')),
	array('label'=>'Update Leftrigtbonus', 'url'=>array('update', 'id'=>$model->bonus_id)),
	array('label'=>'Delete Leftrigtbonus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->bonus_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Leftrigtbonus', 'url'=>array('admin')),
);
?>

<h1>View Leftrigtbonus #<?php echo $model->bonus_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'bonus_id',
		'user_id',
		'left_id',
		'right_id',
	),
)); ?>

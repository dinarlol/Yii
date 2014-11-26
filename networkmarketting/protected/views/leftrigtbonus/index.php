<?php
/* @var $this LeftrigtbonusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Leftrigtbonuses',
);

$this->menu=array(
	array('label'=>'Create Leftrigtbonus', 'url'=>array('create')),
	array('label'=>'Manage Leftrigtbonus', 'url'=>array('admin')),
);
?>

<h1>Leftrigtbonuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

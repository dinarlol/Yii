<?php
/* @var $this StageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Stages',
);

$this->menu=array(
	array('label'=>'Create Stage', 'url'=>array('create')),
	array('label'=>'Manage Stage', 'url'=>array('admin')),
);
?>

<h1>Stages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

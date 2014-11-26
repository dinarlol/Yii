<?php
/* @var $this UserstageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Userstages',
);

$this->menu=array(
	array('label'=>'Create Userstage', 'url'=>array('create')),
	array('label'=>'Manage Userstage', 'url'=>array('admin')),
);
?>

<h1>Userstages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

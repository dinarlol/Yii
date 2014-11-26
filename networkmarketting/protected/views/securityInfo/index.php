<?php
/* @var $this SecurityInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Security Infos',
);

$this->menu=array(
	array('label'=>'Create SecurityInfo', 'url'=>array('create')),
	array('label'=>'Manage SecurityInfo', 'url'=>array('admin')),
);
?>

<h1>Security Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this LoginInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Login Infos',
);

$this->menu=array(
	array('label'=>'Create LoginInfo', 'url'=>array('create')),
	array('label'=>'Manage LoginInfo', 'url'=>array('admin')),
);
?>

<h1>Login Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

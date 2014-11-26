<?php
/* @var $this UserEditController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Edits',
);

$this->menu=array(
	array('label'=>'Create UserEdit', 'url'=>array('create')),
	array('label'=>'Manage UserEdit', 'url'=>array('admin')),
);
?>

<h1>User Edits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

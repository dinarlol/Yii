<?php
/* @var $this UserMailBoxDraftsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Mail Box Drafts',
);

$this->menu=array(
	array('label'=>'Create UserMailBoxDrafts', 'url'=>array('create')),
	array('label'=>'Manage UserMailBoxDrafts', 'url'=>array('admin')),
);
?>

<h1>User Mail Box Drafts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this UserMailBoxMailsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Mail Box Mails',
);

$this->menu=array(
	array('label'=>'Create UserMailBoxMails', 'url'=>array('create')),
	array('label'=>'Manage UserMailBoxMails', 'url'=>array('admin')),
);
?>

<h1>User Mail Box Mails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

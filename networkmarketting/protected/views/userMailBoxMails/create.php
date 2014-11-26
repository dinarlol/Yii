<?php
/* @var $this UserMailBoxMailsController */
/* @var $model UserMailBoxMails */

$this->breadcrumbs=array(
	'User Mail Box Mails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserMailBoxMails', 'url'=>array('index')),
	array('label'=>'Manage UserMailBoxMails', 'url'=>array('admin')),
);
?>

<h1>Create UserMailBoxMails</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
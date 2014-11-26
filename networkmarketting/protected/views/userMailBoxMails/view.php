<?php
/* @var $this UserMailBoxMailsController */
/* @var $model UserMailBoxMails */

$this->breadcrumbs=array(
	'User Mail Box Mails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserMailBoxMails', 'url'=>array('index')),
	array('label'=>'Create UserMailBoxMails', 'url'=>array('create')),
	array('label'=>'Update UserMailBoxMails', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserMailBoxMails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserMailBoxMails', 'url'=>array('admin')),
);
?>

<h1>View UserMailBoxMails #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'subject',
		'message',
		'create_date',
		'senderUserId',
		'receiverUserId',
		'isRead',
		'sender_deleted',
		'receiver_deleted',
		'modified_date',
	),
)); ?>

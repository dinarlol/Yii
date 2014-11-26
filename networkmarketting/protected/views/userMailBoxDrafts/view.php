<?php
/* @var $this UserMailBoxDraftsController */
/* @var $model UserMailBoxDrafts */

$this->breadcrumbs=array(
	'User Mail Box Drafts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserMailBoxDrafts', 'url'=>array('index')),
	array('label'=>'Create UserMailBoxDrafts', 'url'=>array('create')),
	array('label'=>'Update UserMailBoxDrafts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserMailBoxDrafts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserMailBoxDrafts', 'url'=>array('admin')),
);
?>

<h1>View UserMailBoxDrafts #<?php echo $model->id; ?></h1>

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
		'modified_date',
	),
)); ?>

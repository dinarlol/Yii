<?php
/* @var $this UserMailBoxDraftsController */
/* @var $data UserMailBoxDrafts */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('senderUserId')); ?>:</b>
	<?php echo CHtml::encode($data->senderUserId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiverUserId')); ?>:</b>
	<?php echo CHtml::encode($data->receiverUserId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isRead')); ?>:</b>
	<?php echo CHtml::encode($data->isRead); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sender_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->sender_deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	*/ ?>

</div>
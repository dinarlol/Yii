<?php
/* @var $this UserMailBoxMailsController */
/* @var $model UserMailBoxMails */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>55,'maxlength'=>55)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message'); ?>
		<?php echo $form->textField($model,'message',array('size'=>60,'maxlength'=>810)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'senderUserId'); ?>
		<?php echo $form->textField($model,'senderUserId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiverUserId'); ?>
		<?php echo $form->textField($model,'receiverUserId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isRead'); ?>
		<?php echo $form->textField($model,'isRead'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sender_deleted'); ?>
		<?php echo $form->textField($model,'sender_deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiver_deleted'); ?>
		<?php echo $form->textField($model,'receiver_deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_date'); ?>
		<?php echo $form->textField($model,'modified_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
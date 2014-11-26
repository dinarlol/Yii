<?php
/* @var $this UserMailBoxDraftsController */
/* @var $model UserMailBoxDrafts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-mail-box-drafts-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textField($model,'message',array('size'=>60,'maxlength'=>810)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'senderUserId'); ?>
		<?php echo $form->textField($model,'senderUserId'); ?>
		<?php echo $form->error($model,'senderUserId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receiverUserId'); ?>
		<?php echo $form->textField($model,'receiverUserId'); ?>
		<?php echo $form->error($model,'receiverUserId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isRead'); ?>
		<?php echo $form->textField($model,'isRead'); ?>
		<?php echo $form->error($model,'isRead'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sender_deleted'); ?>
		<?php echo $form->textField($model,'sender_deleted'); ?>
		<?php echo $form->error($model,'sender_deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_date'); ?>
		<?php echo $form->textField($model,'modified_date'); ?>
		<?php echo $form->error($model,'modified_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
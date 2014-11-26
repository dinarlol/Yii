<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-story-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'story'); ?>
		<?php echo $form->textField($model,'story',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'story'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quote'); ?>
		<?php echo $form->textField($model,'quote',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'quote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inspiration'); ?>
		<?php echo $form->textField($model,'inspiration',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'inspiration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'impact'); ?>
		<?php echo $form->textField($model,'impact',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'impact'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
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
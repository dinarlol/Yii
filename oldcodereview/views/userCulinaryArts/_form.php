<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-culinary-arts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'usesr_id'); ?>
		<?php echo $form->textField($model,'usesr_id'); ?>
		<?php echo $form->error($model,'usesr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chefs_inspired_by'); ?>
		<?php echo $form->textField($model,'chefs_inspired_by',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'chefs_inspired_by'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-looking-to-hire-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'looking_to_hire'); ?>
		<?php echo $form->textField($model,'looking_to_hire',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'looking_to_hire'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id',array('size'=>14,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
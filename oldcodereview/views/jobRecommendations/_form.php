<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-recommendations-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_group_id'); ?>
		<?php echo $form->textField($model,'user_group_id'); ?>
		<?php echo $form->error($model,'user_group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_id'); ?>
		<?php echo $form->textField($model,'job_id'); ?>
		<?php echo $form->error($model,'job_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommender_id'); ?>
		<?php echo $form->textField($model,'recommender_id'); ?>
		<?php echo $form->error($model,'recommender_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textField($model,'comments',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'show'); ?>
		<?php echo $form->textField($model,'show'); ?>
		<?php echo $form->error($model,'show'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommender_name'); ?>
		<?php echo $form->textField($model,'recommender_name',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'recommender_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommender_current_position'); ?>
		<?php echo $form->textField($model,'recommender_current_position',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'recommender_current_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommender_email'); ?>
		<?php echo $form->textField($model,'recommender_email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'recommender_email'); ?>
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
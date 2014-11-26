<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-job-_form-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'job_title'); ?>
		<?php echo $form->textField($model,'job_title'); ?>
		<?php echo $form->error($model,'job_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employer_id'); ?>
		<?php echo $form->textField($model,'employer_id'); ?>
		<?php echo $form->error($model,'employer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_category_id'); ?>
		<?php echo $form->textField($model,'job_category_id'); ?>
		<?php echo $form->error($model,'job_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_publishing_date'); ?>
		<?php echo $form->textField($model,'job_publishing_date'); ?>
		<?php echo $form->error($model,'job_publishing_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_expiredate'); ?>
		<?php echo $form->textField($model,'job_expiredate'); ?>
		<?php echo $form->error($model,'job_expiredate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_type_id'); ?>
		<?php echo $form->textField($model,'job_type_id'); ?>
		<?php echo $form->error($model,'job_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_description'); ?>
		<?php echo $form->textField($model,'job_description'); ?>
		<?php echo $form->error($model,'job_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number_of_post'); ?>
		<?php echo $form->textField($model,'number_of_post'); ?>
		<?php echo $form->error($model,'number_of_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country'); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city'); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'degree_level_id'); ?>
		<?php echo $form->textField($model,'degree_level_id'); ?>
		<?php echo $form->error($model,'degree_level_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'career_level_id'); ?>
		<?php echo $form->textField($model,'career_level_id'); ?>
		<?php echo $form->error($model,'career_level_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'experience'); ?>
		<?php echo $form->textField($model,'experience'); ?>
		<?php echo $form->error($model,'experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'experience_in'); ?>
		<?php echo $form->textField($model,'experience_in'); ?>
		<?php echo $form->error($model,'experience_in'); ?>
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
		<?php echo $form->labelEx($model,'job_keywords'); ?>
		<?php echo $form->textField($model,'job_keywords'); ?>
		<?php echo $form->error($model,'job_keywords'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
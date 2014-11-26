<div class="form-container">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-job-form',
	'enableAjaxValidation'=>false,
)); ?>
    <fieldset><legend>Post Job</legend>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'job_title'); ?>
		<?php echo $form->textField($model,'job_title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'job_title'); ?>
	</div>
               
        <div class="row">
		<?php echo $form->labelEx($model,'number_of_post'); ?>
		<?php echo $form->textField($model,'number_of_post'); ?>
		<?php echo $form->error($model,'number_of_post'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'job_category_id'); ?>
		<?php echo $form->textField($model,'job_category_id'); ?>
		<?php echo $form->error($model,'job_category_id'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'job_type_id'); ?>
		<?php echo $form->textField($model,'job_type_id'); ?>
		<?php echo $form->error($model,'job_type_id'); ?>
	</div>
              
        
	<div class="row">
		<?php echo $form->labelEx($model,'employer_id'); ?>
		<?php echo $form->textField($model,'employer_id'); ?>
		<?php echo $form->error($model,'employer_id'); ?>
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
		<?php echo $form->labelEx($model,'job_description'); ?>
		<?php echo $form->textArea($model,'job_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'job_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_keywords'); ?>
		<?php echo $form->textField($model,'job_keywords',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'job_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'status'); ?>
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
</fieldset>
<?php $this->endWidget(); ?>
        

</div><!-- form -->
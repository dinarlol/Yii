<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php echo $form->errorSummary($model->companyDetails); ?>
	

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'company_info'); ?>
		<?php echo $form->textField($model->companyDetails,'company_info',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model->companyDetails,'company_info'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'description'); ?>
		<?php echo $form->textArea($model->companyDetails,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model->companyDetails,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'website_url'); ?>
		<?php echo $form->textField($model->companyDetails,'website_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->companyDetails,'website_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'email'); ?>
		<?php echo $form->textField($model->companyDetails,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->companyDetails,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'phone'); ?>
		<?php echo $form->textField($model->companyDetails,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model->companyDetails,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'country'); ?>
		<?php echo $form->textField($model->companyDetails,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->companyDetails,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'city'); ?>
		<?php echo $form->textField($model->companyDetails,'city',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->companyDetails,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'state'); ?>
		<?php echo $form->textField($model->companyDetails,'state',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->companyDetails,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'street'); ?>
		<?php echo $form->textField($model->companyDetails,'street',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->companyDetails,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->companyDetails,'zip'); ?>
		<?php echo $form->textField($model->companyDetails,'zip',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model->companyDetails,'zip'); ?>
	</div>

	<div class="hide">
		<?php echo $form->labelEx($model->companyDetails,'create_date'); ?>
		<?php echo $form->textField($model->companyDetails,'create_date'); ?>
		<?php echo $form->error($model->companyDetails,'create_date'); ?>
	</div>
	

	<div class="hide">
	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'industry_id'); ?>
		<?php echo $form->textField($model,'industry_id'); ?>
		<?php echo $form->error($model,'industry_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'range_id'); ?>
		<?php echo $form->textField($model,'range_id'); ?>
		<?php echo $form->error($model,'range_id'); ?>
	</div>


</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
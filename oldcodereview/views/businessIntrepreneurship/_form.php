<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'business-intrepreneurship-form',
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
		<?php echo $form->labelEx($model,'upload_work'); ?>
		<?php echo $form->textField($model,'upload_work',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'upload_work'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'relevant_business_projects'); ?>
		<?php echo $form->textField($model,'relevant_business_projects',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'relevant_business_projects'); ?>
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
		<?php echo $form->labelEx($model,'ventures'); ?>
		<?php echo $form->textField($model,'ventures',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'ventures'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inspiredby'); ?>
		<?php echo $form->textField($model,'inspiredby',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'inspiredby'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
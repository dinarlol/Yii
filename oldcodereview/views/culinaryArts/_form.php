<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'culinary-arts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>14,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'upload'); ?>
		<?php echo $form->textField($model,'upload',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'upload'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inspiredby'); ?>
		<?php echo $form->textField($model,'inspiredby',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'inspiredby'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
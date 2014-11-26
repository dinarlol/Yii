<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-form',
	'enableAjaxValidation'=>false,
		'action'=>'index.php?r=user/create',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($loginmodel); ?>

	


	<div class="row">
		<?php echo $form->labelEx($loginmodel,'email'); ?>
		<?php echo $form->textField($loginmodel,'email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($loginmodel,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($loginmodel,'password'); ?>
		<?php echo $form->passwordField($loginmodel,'password',array('size'=>60,'maxlength'=>95)); ?>
		<?php echo $form->error($loginmodel,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($loginmodel,'repeat_password'); ?>
		<?php echo $form->passwordField($loginmodel,'repeat_password',array('size'=>60,'maxlength'=>95)); ?>
		<?php echo $form->error($loginmodel,'repeat_password'); ?>
	</div>


	<div class="hiddenrow">
		<?php echo $form->labelEx($loginmodel,'lng'); ?>
		<?php echo $form->textField($loginmodel,'lng',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($loginmodel,'lng'); ?>
	</div>

	<div class="hiddenrow">
		<?php echo $form->labelEx($loginmodel,'lat'); ?>
		<?php echo $form->textField($loginmodel,'lat',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($loginmodel,'lat'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($userdetailmodel,'user_id'); ?>
		<?php echo $form->textField($userdetailmodel,'user_id',array('size'=>14,'maxlength'=>14)); ?>
		<?php echo $form->error($userdetailmodel,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userdetailmodel,'first_name'); ?>
		<?php echo $form->textField($userdetailmodel,'first_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($userdetailmodel,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userdetailmodel,'last_name'); ?>
		<?php echo $form->textField($userdetailmodel,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($userdetailmodel,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userdetailmodel,'dob'); ?>
		<?php echo $form->textField($userdetailmodel,'dob'); ?>
		<?php echo $form->error($userdetailmodel,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userdetailmodel,'country'); ?>
		<?php echo $form->textField($userdetailmodel,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userdetailmodel,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userdetailmodel,'city'); ?>
		<?php echo $form->textField($userdetailmodel,'city',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userdetailmodel,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userdetailmodel,'state'); ?>
		<?php echo $form->textField($userdetailmodel,'state',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userdetailmodel,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userdetailmodel,'street'); ?>
		<?php echo $form->textField($userdetailmodel,'street',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userdetailmodel,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userdetailmodel,'zip'); ?>
		<?php echo $form->textField($userdetailmodel,'zip',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userdetailmodel,'zip'); ?>
	</div>
		
		<div class="row buttons">
		<?php echo CHtml::submitButton($userdetailmodel->isNewRecord ? 'Register' : 'Save'); ?>
	</div>
		
		
			
	<?php $this->endWidget(); ?>

</div><!-- form -->


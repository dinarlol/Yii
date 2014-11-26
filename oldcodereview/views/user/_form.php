 <div id="tab1" class="tab_content">
 <div id="stylized" class="myform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-details-form',
	'enableAjaxValidation'=>false,
		'action'=>'index.php?r=user/create',
)); ?>

	

	User Register
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($userdetailmodel); ?>
	<?php echo $form->errorSummary($loginmodel); ?>
	
	


	
		<?php echo $form->labelEx($loginmodel,'email'); ?>
		<?php echo $form->textField($loginmodel,'email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($loginmodel,'email'); ?>
		<?php echo $form->labelEx($loginmodel,'repeat_email'); ?>
		<?php echo $form->textField($loginmodel,'repeat_email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($loginmodel,'repeat_email'); ?>
			<?php echo $form->labelEx($loginmodel,'password'); ?>
		<?php echo $form->passwordField($loginmodel,'password',array('size'=>60,'maxlength'=>95)); ?>
		<?php echo $form->error($loginmodel,'password'); ?>
		<?php echo $form->labelEx($loginmodel,'repeat_password'); ?>
		<?php echo $form->passwordField($loginmodel,'repeat_password',array('size'=>60,'maxlength'=>95)); ?>
		<?php echo $form->error($loginmodel,'repeat_password'); ?>
	

	<div class="hide">
		<?php echo $form->labelEx($loginmodel,'lng'); ?>
		<?php echo $form->textField($loginmodel,'lng',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($loginmodel,'lng'); ?>
	</div>

	<div class="hide">
		<?php echo $form->labelEx($loginmodel,'lat'); ?>
		<?php echo $form->textField($loginmodel,'lat',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($loginmodel,'lat'); ?>
	</div>

	
		<?php echo $form->labelEx($userdetailmodel,'first_name'); ?>
		<?php echo $form->textField($userdetailmodel,'first_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($userdetailmodel,'first_name'); ?>
	
		<?php echo $form->labelEx($userdetailmodel,'last_name'); ?>
		<?php echo $form->textField($userdetailmodel,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($userdetailmodel,'last_name'); ?>
	
		<?php echo $form->labelEx($userdetailmodel,'dob'); ?>
		<?php echo $form->textField($userdetailmodel,'dob'); ?>
		<?php echo $form->error($userdetailmodel,'dob'); ?>
	
		<?php echo $form->labelEx($userdetailmodel,'country'); ?>
		<?php echo $form->textField($userdetailmodel,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userdetailmodel,'country'); ?>
	
		<?php echo $form->labelEx($userdetailmodel,'city'); ?>
		<?php echo $form->textField($userdetailmodel,'city',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userdetailmodel,'city'); ?>
	
		<?php echo $form->labelEx($userdetailmodel,'state'); ?>
		<?php echo $form->textField($userdetailmodel,'state',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userdetailmodel,'state'); ?>
	
		<?php echo $form->labelEx($userdetailmodel,'zip'); ?>
		<?php echo $form->textField($userdetailmodel,'zip',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userdetailmodel,'zip'); ?>
	
		
		<?php echo CHtml::submitButton($userdetailmodel->isNewRecord ? 'Register' : 'Save',array('class'=>'button')); ?>

		
		
			
	<?php $this->endWidget(); ?>
	</div>
</div>

 <div id="tab2" class="tab_content">
 <div id="stylized" class="myform">
<?php echo $this->renderPartial('webroot.protected.views.companyhome._form', array('model'=>$companydetailmodel,'reqparams'=>$reqparams,'loginmodel'=>$loginmodel)); ?>
</div>
</div>


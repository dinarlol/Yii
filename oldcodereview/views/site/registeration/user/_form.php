 <div id="tab1" class="tab_content">
 <div id="stylized" class="myform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-details-form',
	'enableAjaxValidation'=>false,
		'action'=>CController::createUrl('registeruser'),
)); ?>

	
	User Register
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary(array($userloginform,$userloginform->userDetails)); ?>
	
	


	
		<?php echo $form->labelEx($userloginform,'email'); ?>
		<?php echo $form->textField($userloginform,'email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($userloginform,'email'); ?>
		

	<div class="hide">
		<?php echo $form->labelEx($userloginform,'lng'); ?>
		<?php echo $form->textField($userloginform,'lng',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($userloginform,'lng'); ?>
	</div>

	<div class="hide">
		<?php echo $form->labelEx($userloginform,'lat'); ?>
		<?php echo $form->textField($userloginform,'lat',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($userloginform,'lat'); ?>
	</div>

	
		<?php echo $form->labelEx($userloginform->userDetails,'first_name'); ?>
		<?php echo $form->textField($userloginform->userDetails,'first_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($userloginform->userDetails,'first_name'); ?>
	
		<?php echo $form->labelEx($userloginform->userDetails,'last_name'); ?>
		<?php echo $form->textField($userloginform->userDetails,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($userloginform->userDetails,'last_name'); ?>
	<div class="row">
		<?php echo $form->labelEx($userloginform->userDetails,'dob'); ?>
	
			<?php $this->widget('application.extensions.jui.EDatePicker',
     array(
          'attribute'=>'dob', // Model attribute filed which hold user input
          'model'=>$userloginform->userDetails,            // Model name
          'language'=>'en',
          'mode'=>'imagebutton',
          'value'=>date('Y-m-d'),
          'htmlOptions'=>array('size'=>15),
          'fontSize'=>'0.8em'
         )
      );?>
		</div>
		<?php echo $form->error($userloginform->userDetails,'dob'); ?>
	
		<?php echo $form->labelEx($userloginform->userDetails,'country'); ?>
		<?php echo $form->textField($userloginform->userDetails,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userloginform->userDetails,'country'); ?>
	
		<?php echo $form->labelEx($userloginform->userDetails,'city'); ?>
		<?php echo $form->textField($userloginform->userDetails,'city',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userloginform->userDetails,'city'); ?>
	
		<?php echo $form->labelEx($userloginform->userDetails,'state'); ?>
		<?php echo $form->textField($userloginform->userDetails,'state',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userloginform->userDetails,'state'); ?>
	
		<?php echo $form->labelEx($userloginform->userDetails,'zip'); ?>
		<?php echo $form->textField($userloginform->userDetails,'zip',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($userloginform->userDetails,'zip'); ?>
	
		
		<?php echo CHtml::submitButton($userloginform->userDetails->isNewRecord ? 'Register' : 'Save',array('class'=>'button')); ?>

			
	<?php $this->endWidget(); ?>
	</div>
</div>

 <div id="tab2" class="tab_content">
 <div id="stylized" class="myform">
<?php 

echo $this->renderPartial('registeration/company/_form', array('model'=>$model,'companyloginform'=>$companyloginform,'reqparams'=>$reqparams));


?>
</div>
</div>


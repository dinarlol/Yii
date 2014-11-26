<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
		'action'=>CController::createUrl('registercompany'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($companyloginform,$companyloginform->company)); ?>
	
		<?php echo $form->labelEx($companyloginform,'email'); ?>
		<?php echo $form->textField($companyloginform,'email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($companyloginform,'email'); ?>
	
		

	<div class="hide">
		<?php echo $form->labelEx($companyloginform,'lng'); ?>
		<?php echo $form->textField($companyloginform,'lng',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($companyloginform,'lng'); ?>
	</div>

	<div class="hide">
		<?php echo $form->labelEx($companyloginform,'lat'); ?>
		<?php echo $form->textField($companyloginform,'lat',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($companyloginform,'lat'); ?>
	</div>
	

				<?php echo $form->labelEx($companyloginform->company ,'name'); ?>
		<?php echo $form->textField($companyloginform->company ,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($companyloginform->company ,'name'); ?>
	
		<?php echo $form->labelEx($reqparams['industry'][0],'name'); ?>
		
	<?php echo $form->dropDownList($reqparams['industry'][0],'id', CHtml::listData($reqparams['industry'], 'id', 'name'), array('empty'=>'select Industry')); ?>	
		
	<br/><br/>
		
		
		
		<?php echo $form->labelEx($reqparams['range'][0],'range'); ?>
		
		
		
		
	
<?php echo $form->dropDownList($reqparams['range'][0],'id', CHtml::listData($reqparams['range'], 'id', 'range'), array('empty'=>'select Employees')); ?>	
	

<?php echo $form->error($companyloginform->company ,'range_id'); ?>


		<?php echo CHtml::submitButton($companyloginform->company ->isNewRecord ? 'Register' : 'Save',array('class'=>'button')); ?>


<?php $this->endWidget(); ?>

</div><!-- form -->
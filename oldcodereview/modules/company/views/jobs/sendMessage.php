
	<?php $formresetId   = uniqid('form_message_');?>
	
	
	<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'job-manage-message-dialog',
		'cssFile'=>'',
		'options'=>array(
				'title'=>'Send Message',
				//	'autoOpen'=>false,
				'modal'=>true,
				'width'=>430,
				'close'=>'js:function(){$("#'.$formresetId.'").click();}',
				//'open'=>'js:function(){$("#'.$formresetId.'").reset();}',
				
				
		),
)); ?>
	
	
	<div class="span13">
		

		<div class="form">
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'job-message-form',
				'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),
			)); ?>

			<fieldset>
			<legend>Compose Message	</legend>
			
			
			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model, null, null, array('class' => 'alert-message block-message error')); ?>

			<?php echo $form->labelEx($model,'receiverUserId'); ?>
			<div class="input">
				<?php echo CHtml::encode($receiverName)?>
				<?php echo $form->hiddenField($model,'receiverUserId'); ?>
				<?php echo CHtml::hiddenField('jobId',$jobId); ?>
				<?php echo $form->error($model,'receiverUserId'); ?>
			</div>

			<?php echo $form->labelEx($model,'subject'); ?>
			<div class="input">
				<?php echo $form->textField($model,'subject'); ?>
				<?php echo $form->error($model,'subject'); ?>
			</div>

			<?php echo $form->labelEx($model,'message'); ?>
			<div class="input">
				
			
			<?php echo $form->textArea($model, 'message') ?>
				<?php echo $form->error($model,'message'); ?>
				</div>
			
			
			
			

			<div class="buttons">
				<button class="btn primary">
				<?php echo CHtml::submitButton('Send'); ?>
				
				</button>
			</div>
</fieldset>
			<?php $this->endWidget(); ?>

		</div>
	</div>
	
	<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
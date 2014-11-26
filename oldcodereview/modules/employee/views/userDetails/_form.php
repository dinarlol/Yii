<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-details-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
<fieldset>
<legend><?php //echo $type;?>User Details </legend>
        <p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
     
        <div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>
        
</fieldset>
<fieldset><legend>Contact Information</legend>
    <div>
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->textField($model,'zip',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'zip'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
    
</fieldset>
<fieldset>
    <legend>Image</legend>
    <div>
	<?php 
		if(!empty($model->photo_uploader)){
			echo CHtml::image(Yii::app()->baseUrl.$model->photo_uploader->location.$model->photo_uploader->name,$model->photo_uploader->name,array('class'=>'avatar','width'=>'130','height'=>'140'));
	
			echo CHtml::encode($model->photo_uploader->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($model->photo_uploader->name); ?>
	<br />
	
	<?php } ?>
	
	
		<?php echo $form->labelEx($model,'logo'); ?>
		
		<?php $this->widget('CMultiFileUpload', array(
				'id'=>'logo_upload',
				'name'=>AkimboNuggetManager::$content_type_photo,
				'accept' => 'jpg',
				'denied' => 'Picture should be in .jpg format',
		)); ?>
				
		
	</div>
    <div class="buttonrow">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'basicBtn')); ?>
    </div>
   
</fieldset>	
<?php $this->endWidget(); ?>

<!-- form -->
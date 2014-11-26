

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-detail-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
<fieldset>
<legend><?php echo $type;?> Company Basic Info </legend>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->labelEx($model->company,'name'); ?>
		<?php echo $form->textField($model->company,'name'); ?>
		<?php echo $form->error($model->company,'name'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'company_info'); ?>
		<?php echo $form->textArea($model,'company_info',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'company_info'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'website_url'); ?>
		<?php echo $form->textField($model,'website_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'website_url'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

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
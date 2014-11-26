




<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-writing-literature-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),

)); ?>

<fieldset>
<legend><?php echo $type;?> Writing & Literature </legend>


	<p class="note">Field with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		
	<div>
	

	
	
	<?php  if(!empty($model->id)){echo $form->hiddenField($model,'id');}?>
	<?php  if(!empty($model->create_date)){echo $form->hiddenField($model,'create_date');}?>
	<?php  if(!empty($model->user_id)){echo $form->hiddenField($model,'user_id');}?>
	<?php  if(!empty($model->upload)){
		echo CHtml::image(Yii::app()->baseUrl.$model->upload,array('class'=>'avatar','width'=>'130','height'=>'140'));
	}
		?>
		
		
		
		
				<div>
				
				<?php $readBook = new UserReadBooks();?>
				
		
	</div>
	
		<div>
				
	<?php $book = new Books();?>
	
		<?php echo $form->labelEx($book,'isbn'); ?>
		<?php echo $form->textField($book,'isbn'); ?>
		<?php echo $form->error($book,'isbn'); ?>
		<?php 
		echo CHtml::ajaxLink('Lookup', $this->createAbsoluteUrl('search'),
				array('update'=>'#bookshelve','data'=>'js:$("#user-writing-literature-form").serialize()'), array('class'=>'input','id'=>'bookshelves-link'));
		
		?>
		
	</div>
	
	<div id="bookshelve">
	
	</div>
	
	
		<div>
		<?php echo $form->labelEx($model,'writer_inspired_by'); ?>
		<?php echo $form->textField($model,'writer_inspired_by',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'writer_inspired_by'); ?>
	</div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'writing samples'); ?>
		
		<?php $this->widget('CMultiFileUpload', array(
				'id'=>'upload',
				'name'=>AkimboNuggetManager::$content_type_document,
				'accept' => 'pdf',
		)); ?>
		<?php echo $form->error($model,'pics_id'); ?>
			</div>

	
		<div class="buttonrow">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'basicBtn'));  
                 ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

<!-- form -->
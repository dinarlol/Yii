
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'sb-form',
	'enableAjaxValidation'=>false,
)); ?>


	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>



	<?php echo $form->textFieldRow($model,'point',array('class'=>'span5')); ?>



	<?php echo $form->textFieldRow($model,'paid',array('class'=>'span5')); ?>



	<?php echo $form->textFieldRow($model,'commissionid',array('class'=>'span5')); ?>



	<?php echo $form->textFieldRow($model,'created_date',array('class'=>'span5')); ?>



	<?php echo $form->textFieldRow($model,'modified_date',array('class'=>'span5')); ?>



	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>

	</div>

<?php $this->endWidget(); ?>


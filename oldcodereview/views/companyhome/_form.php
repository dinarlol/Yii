<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
		'action'=>'index.php?r=companyhome/create',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

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
	

		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
			<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	
		<?php echo $form->labelEx($model,'industry_id'); ?>
			<select name="Company[industry_id]">
<?php 
	foreach ($reqparams['industry'] as $industry){
	echo '<option value="'.$industry->id.'">'.$industry->name.'</option>';
	}

?>
</select>
		<?php echo $form->error($model,'industry_id'); ?>
			<?php echo $form->labelEx($model,'range_id'); ?>
		<select name="Company[range_id]">
		<?php foreach ($reqparams['range'] as $range){
	echo '<option value="'.$range->id.'">'.$range->from.' -- '.$range->to.'</option>';
	}

?>
</select>
		<?php echo $form->error($model,'range_id'); ?>
	


		<?php echo CHtml::submitButton($model->isNewRecord ? 'Register' : 'Save',array('class'=>'button')); ?>


<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_group_id'); ?>
		<?php echo $form->textField($model,'user_group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_id'); ?>
		<?php echo $form->textField($model,'job_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recommender_id'); ?>
		<?php echo $form->textField($model,'recommender_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comments'); ?>
		<?php echo $form->textField($model,'comments',array('size'=>60,'maxlength'=>99)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'show'); ?>
		<?php echo $form->textField($model,'show'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recommender_name'); ?>
		<?php echo $form->textField($model,'recommender_name',array('size'=>60,'maxlength'=>77)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recommender_current_position'); ?>
		<?php echo $form->textField($model,'recommender_current_position',array('size'=>60,'maxlength'=>77)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recommender_email'); ?>
		<?php echo $form->textField($model,'recommender_email',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_date'); ?>
		<?php echo $form->textField($model,'modified_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
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
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school'); ?>
		<?php echo $form->textField($model,'school',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'graduation_date'); ?>
		<?php echo $form->textField($model,'graduation_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'major_subject_id'); ?>
		<?php echo $form->textField($model,'major_subject_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'minor_subject_id'); ?>
		<?php echo $form->textField($model,'minor_subject_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'concentration'); ?>
		<?php echo $form->textField($model,'concentration',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gpa'); ?>
		<?php echo $form->textField($model,'gpa'); ?>
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
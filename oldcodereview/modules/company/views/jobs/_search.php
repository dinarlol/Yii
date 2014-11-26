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
		<?php echo $form->label($model,'job_title'); ?>
		<?php echo $form->textField($model,'job_title',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employer_id'); ?>
		<?php echo $form->textField($model,'employer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_category_id'); ?>
		<?php echo $form->textField($model,'job_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_of_post'); ?>
		<?php echo $form->textField($model,'number_of_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_publishing_date'); ?>
		<?php echo $form->textField($model,'job_publishing_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_expiredate'); ?>
		<?php echo $form->textField($model,'job_expiredate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_type_id'); ?>
		<?php echo $form->textField($model,'job_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_description'); ?>
		<?php echo $form->textArea($model,'job_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_keywords'); ?>
		<?php echo $form->textField($model,'job_keywords',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>8,'maxlength'=>8)); ?>
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
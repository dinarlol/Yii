<?php
/* @var $this LeftrigtbonusController */
/* @var $model Leftrigtbonus */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'bonus_id'); ?>
		<?php echo $form->textField($model,'bonus_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'left_id'); ?>
		<?php echo $form->textField($model,'left_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'right_id'); ?>
		<?php echo $form->textField($model,'right_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php
/* @var $this SecurityInfoController */
/* @var $model SecurityInfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'security_quest_id'); ?>
		<?php echo $form->textField($model,'security_quest_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'security_quest'); ?>
		<?php echo $form->textField($model,'security_quest',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
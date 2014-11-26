<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createAbsoluteUrl("/viewRiseTree/index"),
	'method'=>'post',
)); ?>

	<?php echo $form->textFieldRow($model,'search',array('class'=>'span5')); ?>

	

<?php $this->endWidget(); ?>

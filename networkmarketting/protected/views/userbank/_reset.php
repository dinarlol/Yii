<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(

	'id'=>'userbankreset-form',

	'enableAjaxValidation'=>false,

)); ?>



	<p class="help-block">Fields with <span class="required">*</span> are required.</p>



	<?php echo $form->errorSummary($model); ?>





	<?php echo $form->textFieldRow($model,'user_name',array('class'=>'span5')); ?>



	<div class="form-actions">

		<?php $this->widget('bootstrap.widgets.TbButton', array(

			'buttonType'=>'submit',

			'type'=>'primary',

			'label'=>"reset",

		)); ?>

	</div>



<?php $this->endWidget(); ?>


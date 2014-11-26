<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>


        <?php $model = new Users(); ?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
        <h1>Security Confirmation</h1>
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model,'security_quest'); ?>
            
        <?php echo $form->dropDownList($model,'security_quest_id', CHtml::listData(SecurityInfo::model()->findAll(), 'security_quest_id', 'security_quest'), array('empty'=>'---Select Question---'), array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'answer',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->passwordFieldRow($model,'pincode',array('class'=>'span5')); ?>

	
            
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Confirm' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

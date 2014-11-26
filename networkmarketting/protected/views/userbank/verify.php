

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>$_SERVER['REQUEST_URI'],
	'method'=>'post',
)); ?>

  <span>
            <?php echo CHtml::ajaxButton('Send Security Reminder to my primary email',
        array('lookup/securityReminder'),
        array(
            'beforeSend' => 'function(){
      $("#verifybox").addClass("loading alert");}',
    'complete' => 'function(){
      $("#verifybox").removeClass("loading alert");}',
            'update'=>'#verifybox',
            'type'=>'post',
            

        ),
                    array('class'=> 'btn-danger')
        
);?>
            
        </span>
        <span id="verifybox"></span>
     
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

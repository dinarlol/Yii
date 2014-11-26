<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(

	'id'=>'upgrade-form',

	'enableAjaxValidation'=>false,

)); ?>



	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'primary_email',array('class'=>'span5','maxlength'=>100)); ?>

            <?php echo $form->hiddenField($model,'full_name'); ?>

   <?php echo $form->textFieldRow($model,'verified_pin',array('class'=>'span1','maxlength'=>4)); ?>

        <span>

            <?php echo CHtml::ajaxButton('Send Verification Code',

        array('lookup/emailVerify'),

        array(

                        'update'=>'#verifybox',

            'data'=> "js:$('#upgrade-form').serialize()",

            'type'=>'post',

        )

        );?>
            
<span id="verifybox"></span>            
<?php echo $form->textAreaRow($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'mobile',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">

		<?php $this->widget('bootstrap.widgets.TbButton', array(

			'buttonType'=>'submit',

			'type'=>'primary',

			'label'=>'Upgrade',
		)); ?>

	</div>
<?php $this->endWidget(); ?>


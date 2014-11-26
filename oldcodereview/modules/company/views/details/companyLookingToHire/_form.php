<div class="form info_right" id="formdata">

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'company-looking-to-hire-form',
        'enableAjaxValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
)); ?>



	<?php echo $form->errorSummary($model); ?>

	<div class="info_right">
		<?php echo $form->labelEx($model,'looking_to_hire'); ?>
		<?php 
		//echo CHtml::dropDownList('CompanyLookingToHire_looking_to_hire[looking_to_hire]','', CompanyProfile::getYesNoDropDownList());
		 echo CHtml::activeDropDownList( $model,'looking_to_hire',ZHtml::enumItem($model, 'looking_to_hire') ); ?>
		
		<?php echo $form->error($model,'looking_to_hire'); ?>
	</div>

	<div class="hide">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id',array('size'=>14,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row buttons">
		<?php 
		echo CHtml::submitButton($model->isNewRecord ? 'Hire' : 'Hire'); 
		
		/*
		echo CHtml::ajaxButton ('Hire', CHtml::normalizeUrl(array("details/completeprofile")),
				array('type' =>'POST','update' => '#formdata','data'=>'js:$("#company-looking-to-hire-form").serialize()'),array('class' => 'input'));
		
		*/
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
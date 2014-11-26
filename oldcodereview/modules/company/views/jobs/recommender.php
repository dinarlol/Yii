 <?php 
 
 $formresetId   = uniqid('form_');
 $nonRegisteredGroup = $model->user_group_id;
 
 
 ?>
 <div id="stylized" class="myform">

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'job-recomendations-dialog',
		'cssFile'=>'',
		'options'=>array(
				'title'=>'Recommend Job',
				'autoOpen'=>false,
				'modal'=>true,
				'width'=>430,
				'close'=>'js:function(){$("#'.$formresetId.'").click();}',
				//'open'=>'js:function(){$("#'.$formresetId.'").reset();}',
				
				
		),
)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-recomendations-form',
	'enableAjaxValidation'=>true,
		'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),
)); ?>


   <?php
   
                   echo CHtml::activeRadioButtonList($model,'user_group_id',
                        $groups,
                        array(
                                'separator'=>'', 
                                'template'=>'<label>{label}</label><span class="jqTransformCheckboxWrapper">{input}</span>',
                                //'labelOptions'=>array('style'=>'inline'),
                        		'id'  => uniqid('keyword_'),
                        		'onclick'=>'if(this.value=="'.$nonRegisteredGroup.'"){$("#recommender_").hide();$("#recommender_external_").show();$("#recommender_email_").show();}else{$("#recommender_external_").hide();$("#recommender_email_").hide();$("#recommender_").show();}',
                        		 'return'=>true,
                        ));
               
        ?>
	<?php echo $form->error($model,'user_group_id'); ?>

	
	<div class="row" id="recommender_external_">
		<?php echo $form->labelEx($model,'externalRecommendedUser'); ?>
		<?php echo $form->textField($model,'externalRecommendedUser',array('size'=>60,'maxlength'=>77,'id'  => uniqid('recommender_external_'),)); ?>
		<?php echo $form->error($model,'externalRecommendedUser'); ?>
	</div>
	
	
	
<div class="hide" id="recommender_">
		<?php echo $form->labelEx($model,'recommender_name'); ?>
		<?php 	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model,
				'id'  => uniqid('recommender_'),
				'cssFile'=>'',
				'attribute'=>'recommender_name',
				'sourceUrl' => Yii::app()->createAbsoluteUrl('/akimboAutocomplete/userfullNameWithId'),
				'options'=>array(
						'minLength'=>'2',
						'showAnim'=>'fold',
						'select'=>"js: function(event, ui) {
						$('#recommender_id').val(ui.item['id']);
						}"
				),
		
				'htmlOptions'=>array(
						'class'=>'input'
				),
		));?>
		<?php echo $form->hiddenField($model,'recommender_id',array('id'=>'recommender_id')); ?>
		
		<?php 
		
		
		?>
		
		<?php echo $form->hiddenField($model,'job_id',array('id'=>'job_id')); ?>
		<?php echo $form->error($model,'recommender_name'); ?>
	</div>
	
	
	<div class="row" id="recommender_email_">
		<?php echo $form->labelEx($model,'recommender_email'); ?>
		<?php echo $form->textField($model,'recommender_email',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'recommender_email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'known_recommender_as'); ?>
		<?php echo $form->textField($model,'known_recommender_as',array('size'=>40,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'known_recommender_as'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'recommender_current_position'); ?>
		<?php echo $form->textField($model,'recommender_current_position',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'recommender_current_position'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('size'=>30)); ?>
		<?php echo $form->error($model,'comments',array('class'=>'errorMessage xsmall')); ?>
	</div>
	<div class="row buttons">
	<?php echo CHtml::htmlButton('Recomend',array('class'=>'basicBtn','type' => 'submit')); ?>
	<?php echo CHtml::resetButton('',array('class'=>'hide','id'=>$formresetId));?>
		
	</div>
<?php $this->endWidget(); ?>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
	
      </div>
      
     
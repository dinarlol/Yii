<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-recomendations-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		
		<?php $modelUser = Person::model()->findAll();
	
	echo CHtml::activeDropDownList($model, 'user_id', CHtml::listData($modelUser, 'id', 'email'))?>		<?php echo $form->error($model,'user_id'); ?>
		
		<?php echo $form->error($model,'user_id'); ?>
	</div>
	<div>

	</div>
	

	<div class="hide">
		<?php echo $form->labelEx($model,'category_id'); ?>
	<?php $modelB = Category::model()->findAll();
	
	//echo CHtml::activeDropDownList($model, 'category_id', CHtml::listData($modelB, 'id', 'name'))
	
		
	echo CHtml::activeDropDownList($model, 'category_id', $nuggets)?>		<?php echo $form->error($model,'category_id');
	
	?>
	
	
	
	
	</div>


  
  <div>
  
  <?php 
  echo CHtml::dropDownList('nugget_id', '', $nuggets,
  		array(
  				'ajax' => array(
  						'type'=>'POST', //request type
  						'url'=>CController::createUrl('nuggetsfield'), //url to call.
  						//Style: CController::createUrl('currentController/methodToCall')
  						'update'=>'#subcat_id', //selector to update
  						//'data'=>'js:javascript statement'
  //leave out the data key to pass all form values through
  				)));
  
  //empty since it will be filled by the other dropdown
  echo CHtml::dropDownList('subcat_id','', array());
  
  
  ?>
  
  </div>
	
	<div class="hide">
		<?php echo $form->labelEx($model,'recomender_id'); ?>
		<?php echo $form->textField($model,'recomender_id'); ?>
		<?php echo $form->error($model,'recomender_id'); ?>
	</div>

	<div class="hide">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="hide">
		<?php echo $form->labelEx($model,'modified_date'); ?>
		<?php echo $form->textField($model,'modified_date'); ?>
		<?php echo $form->error($model,'modified_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textField($model,'comments',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="hide">
		<?php echo $form->labelEx($model,'category_pk_id'); ?>
		<?php echo $form->textField($model,'category_pk_id'); ?>
		<?php echo $form->error($model,'category_pk_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>



</div><!-- form -->
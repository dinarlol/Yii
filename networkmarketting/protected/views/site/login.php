<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>



		
		
<p>Please fill out the following form with your login credentials:</p>

<div id="form-1" class="cbp-mc-form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
<div class="cbp-mc-column">
	<fieldset>
	<legend>Applicant Login</legend>
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	

	
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>		
	
</div>
<div class="cbp-mc-submit-wrap">
	
		<?php echo CHtml::submitButton('Login',array('class'=>'cbp-mc-submit')); ?>
		
		</div>
</fieldset>

<?php $this->endWidget(); ?>
</div><!-- form -->

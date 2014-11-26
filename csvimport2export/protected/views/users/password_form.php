<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>FALSE,
        'clientOptions'=>array(
            'validateOnSubmit'=>false,
        ),
));

$model->password = '';
if(isset($_POST['password'])){
    $model->password = $_POST['password'];
}

?>	

	<?php echo $form->errorSummary($model); ?>
        <?php if(Yii::app()->user->hasFlash('profileUpdated')): ?>
		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('profileUpdated'); ?>
		</div>
	<?php endif; ?>

	
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'repeat_password'); ?>
		<?php echo $form->passwordField($model,'repeat_password',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'repeat_password'); ?>
	</div>

	
	 <div class="row buttons">
             <?php echo CHtml::button('Cancel',array('class'=>'btn btn btn-warning','onclick'=> "window.location.href ='../'")); ?>
            <?php echo CHtml::submitButton('Save',array('class'=>'btn btn btn-primary')); ?>
            <span> Changes will not show immediately. Please allow 5 days for the online records to reflect any edits.</span>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
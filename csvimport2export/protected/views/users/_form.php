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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attn'); ?>
		<?php echo $form->textField($model,'attn',array('size'=>60,'maxlength'=>123)); ?>
		<?php echo $form->error($model,'attn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>124)); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>123)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>33,'maxlength'=>33)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->textField($model,'zip',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model,'tel',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cell'); ?>
		<?php echo $form->textField($model,'cell',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'cell'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'tax_id'); ?>
		<?php echo $form->textField($model,'tax_id'); ?>
		<?php echo $form->error($model,'tax_id'); ?>
	</div>


	 <div class="row buttons">
             <?php echo CHtml::button('Cancel',array('class'=>'btn btn btn-warning','onclick'=> "window.location.href ='../'")); ?>
            <?php echo CHtml::submitButton('Save',array('class'=>'btn btn btn-primary')); ?>
            <span> Changes will not show immediately. Please allow 5 days for the online records to reflect any edits.</span>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
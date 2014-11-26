<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Password reminder';
$this->breadcrumbs=array(
	'Password reminder',
);
?>

<div class="page-header">
    <h1>Forgot <small>password</small> <span class="divider-vertical"></span> &nbsp;
   
<span class="page-headetext">
        Access is Limited to clients and agents of Freeholder Capital Partners, as well as Beneficiaries under a transfer fee
            covenant administrated by Covenant Clearinghouse 
    </span>
 </h1>
</div>
<div class="row-fluid">
	
    <div class="span6 offset3">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"Mail me a password",
	));
	
?>


    
    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    
        <p class="note">We administrate thousands of accounts. Therefore, in order to help us identify you, please enter as much of the following as possible.</p>
    
        <div class="text-error">
            <?php echo CHtml::errorSummary($model); ?>
</div>
        <div class="row">
            <?php echo $form->labelEx($model,'user_id'); ?>
            <?php echo $form->textField($model,'user_id'); ?>
            <?php echo $form->error($model,'user_id'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>33,'maxlength'=>33)); ?>
		<?php echo $form->error($model,'state'); ?>
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
		<?php echo $form->labelEx($model,'repeat_email'); ?>
		<?php echo $form->textField($model,'repeat_email',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'repeat_email'); ?>
	</div>
    
    
        <div class="row buttons">
             <?php echo CHtml::button('Cancel',array('class'=>'btn btn btn-warning','onclick'=> "window.location.href ='../'")); ?>
            <?php echo CHtml::submitButton('Submit',array('class'=>'btn btn btn-primary')); ?>
            <span> Please allow 1-2 business days</span>
        </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->

<?php $this->endWidget();?>

    </div>

</div>
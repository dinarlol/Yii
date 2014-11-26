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
	<h1>Forgot <small>password</small></h1>
</div>
<div class="row-fluid">
	
    <div class="span6 offset3">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"Mail me a password",
	));
	
?>



    <p>Please fill out the following form:</p>
    
    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    
        <p class="note">Fields with <span class="required">*</span> are required.</p>
    
        <div class="text-error">
            <?php echo CHtml::errorSummary($model); ?>
</div>
        <div class="row">
            <?php echo $form->labelEx($model,'username'); ?>
            <?php echo $form->textField($model,'username'); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
    
    
        <div class="row buttons">
             <?php echo CHtml::button('Cancel',array('class'=>'btn btn btn-warning','onclick'=> "window.location.href ='../'")); ?>
            <?php echo CHtml::submitButton('Email Password',array('class'=>'btn btn btn-primary')); ?>
        </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->

<?php $this->endWidget();?>

    </div>

</div>
<?php


$this->pageTitle=Yii::app()->name . ' - Validate'; ?>

<h1>Validation</h1>

<?php 

if($validate->sessionValid == "Not Sent")
{
    ?>
    <p>Thank you for confirming your pasword has been changed.<br/>
    You may now 
    <?php echo CHtml::link('Login', array('site/login')); ?>.<br/>
    Please check your email as you should receive an email from us
    shortly containing the details to your acccount registration.
    </p>
    <?php
}
else if($validate->sessionValid == "Mail Saved Failed")
{
    ?>
    <p>Your pasword changed successfully.<br/>
    While Your change of password went through successfully and you may now 
    <?php echo CHtml::link('Login', array('site/login')); ?>;
    there was an issue with our system to send your account details via email.<br/>
    Please contact the Website Administrator to inform them of this problem.<br/><br/>
    
    </p>
    <?php 
}
else if($validate->sessionValid == "Sent")
{
	?>
<p>Your pasword changed successfully.<br/>
While Your change of password went through successfully and you may now
<?php echo CHtml::link('Login', array('site/login')); ?>;
we had send you confirmation of password changed via email.<br/>
Please contact the Website Administrator to inform them if any problem.<br/><br/>

</p>
<?php
}
else if($validate->sessionValid == "Not Valid")
{
    ?>
    <p>Your session code has expired.<br/><br/>
    This is because our valid time frame for confirming a registration to our site is 1 day.
    If your code has expired prematurely we sincerely apologize and would request that you
    redo the registration process.<br/> 
    (Your username and other details will still be available)<br/><br/>
    If you run into the same problem again please contact the Website Administration.<br/><br/>
    Since your session code expired you will have to do the registration process again. You can
    sign up for an account <?php echo CHtml::link('Here', array('user/create')); ?>.<br/><br/>
    Thank you for your cooperation.
    </p>
    <?php 
}
else if($validate->sessionValid == "Reset Password")
{
    ?>
    <div class="form">
    <?php $rawform=$this->beginWidget('CActiveForm', array(
	'id'=>'change_pass',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    <?php echo $rawform->errorSummary($form); ?>
    <div>
		<?php echo $rawform->labelEx($form,'password'); ?>
		<?php echo $rawform->passwordField($form,'password'); ?>
		<?php echo $rawform->error($form,'password'); ?>
	
	</div>
	
	 <div>
		<?php echo $rawform->labelEx($form,'repeat_password'); ?>
		<?php echo $rawform->passwordField($form,'repeat_password'); ?>
		<?php echo $rawform->error($form,'repeat_password'); ?>
	
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Change'); ?>
	</div>
    	<div class="row forgotpassword">
		<?php echo CHtml::link("Forgot Password","?r=user/forgotpassword"); ?>
	</div>
<?php $this->endWidget(); ?>

</div>
    <?php 
}
?>
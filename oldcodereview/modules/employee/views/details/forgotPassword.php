<?php
$this->pageTitle=Yii::app()->name . ' - Forgot Password'; ?>

<h1>Forogt Password</h1>

<?php 

if($form->stage == "Sent")
{
    ?>
    <p>
    An e-mail was sent to <?php echo($form->email); ?> with updated account details.
    </p>
    <?php
}
else if($form->stage == "Not Sent")
{
    ?>
    <p>We weren't able to send you the confirmation e-mail.<br/>
    Please contact the Website Administration.
    </p>
    <?php 
}
else if($form->stage == "Mail Saved Failed")
{
    ?>
    <p>While your Password has been successfully changed,
    there was an issue with our system to send your account details via email.<br/>
    Please contact the Website Administrator to inform them of this problem.<br/><br/>
    The following information is the details to your account, please record this information
    and keep it safe from others.<br/><br/>
    Email: <?php echo($form->email);?><br/>
    Password: <?php echo($form->emailPassword);?><br/>
    Email: <?php echo($form->email);?><br/>
    Question: <?php echo($form->question);?><br/>
    Answer: <?php echo($form->answer);?><br/>
    </p>
    <?php 
}

if($form->stage == "Email Not Found")
{
    ?>
    <p>The Email you provided was not found in our database, please try again.</p>
    <?php 
    $form->stage = "Find User";
}

if($form->stage == "Email Not Match")
{
    ?>
    <p>The Email you provided does not match the Email associated with the
     Email found in our database, please try again.</p>
    <?php 
    $form->stage = "Find User";
}

if($form->stage == "Answer Invalid")
{
    ?>
    <p>The Answer you provided was not correct, please try again.</p>
    <?php
    $form->stage = "Answer Question"; 
}

if($form->stage == "Answer Question")
{
    ?>
    <div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>
    
    <?php echo CHtml::errorSummary($form); ?>
    
    <div class="simple">
    Your Question: <?php echo ($form->question); ?>
    </div>
    <div class="simple">
    <p class="hint" style="margin-left:70px;">
    Please Enter Your Secret Answer to Your Secret Question:
    </p>
    <br/>
    <?php echo CHtml::activeLabel($form,'answer', array('style'=>'width:150px;')); ?>
    <?php echo CHtml::activeTextField($form,'answer') ?>
    </div>
    <br/>
    <div class="action">
    <?php echo CHtml::submitButton('Answer'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
    </div><!-- yiiForm -->
    <?php 
}

if($form->stage == "Reset Password")
{
    ?>
    <div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>
    
    <?php echo CHtml::errorSummary($form); ?>
    
    <div class="simple">
    <p class="hint" style="margin-left:70px;">
    Enter a new password for your account:
    </p>
    <br/>
    <?php echo CHtml::activeLabel($form,'password', array('style'=>'width:150px;')); ?>
    <?php echo CHtml::activePasswordField($form,'password') ?>
    </div>
    <div class="simple">
    <?php echo CHtml::activeLabel($form,'password2', array('style'=>'width:150px;')); ?>
    <?php echo CHtml::activePasswordField($form,'password2') ?>
    </div>
    <br/>
    <div class="action">
    <?php echo CHtml::submitButton('Change Password'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
    </div><!-- yiiForm -->
    <?php 
}
if($form->stage == "Answer email")
{
	?>
<div class="yiiForm">
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<div class="simple">
<p class="hint" style="margin-left:70px;">
Enter a new password for your account:
</p>
<br/>
<?php echo CHtml::activeLabel($form,'password', array('style'=>'width:150px;')); ?>
<?php echo CHtml::activePasswordField($form,'password') ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($form,'password2', array('style'=>'width:150px;')); ?>
<?php echo CHtml::activePasswordField($form,'password2') ?>
</div>
<br/>
<div class="action">
<?php echo CHtml::submitButton('Change Password'); ?>
</div>
<?php echo CHtml::endForm(); ?>
</div><!-- yiiForm -->
<?php
}


if($form->stage == "Find User")
{
?>
<div class="form">
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<p class="hint" style="margin-left:70px;">
Please Enter Your Email and Repeat  Email:
</p>
<br/>
<?php echo CHtml::activeLabel($form,'email', array('style'=>'width:150px;')); ?>
<span class="required">*</span>
<?php echo CHtml::activeTextField($form,'email') ?>
<?php echo CHtml::activeLabel($form,'repeat_email', array('style'=>'width:150px;')); ?>
<span class="required">*</span>
<?php echo CHtml::activeTextField($form,'repeat_email') ?>
<br/>
<?php echo CHtml::submitButton('Find Account'); ?>
<?php echo CHtml::endForm(); ?>
</div><!-- yiiForm -->
<?php 
} // close statement


?>
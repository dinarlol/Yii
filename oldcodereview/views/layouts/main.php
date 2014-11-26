<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />


	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/megamenu.css" />
        <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/customFunc.js'); ?>

	<!--[if IE 6]>
<link rel="stylesheet" href="ie/ie6.css" type="text/css" media="screen" />
<![endif]-->
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="ie/ie.css" />
<![endif]-->
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<!-- Top navigation bar -->


<?php if(Yii::app()->user->hasFlash('runbackground')): ?>
	<div class="alert-message success">
		<?php echo Yii::app()->user->getFlash('runbackground'); ?>
	</div>
<?php endif; ?>


<div id="upper_top" > 
<div class="base_div">

    
       <?php 
       if(!Yii::app()->user->isGuest){
	if(Yii::app()->user->isCompany){
	
	?>
      <div class="welcome"><a href="<?php echo Yii::app()->createAbsoluteUrl('company/default/profile');?>" title=""><img src="images/userPic.png" alt="" /></a><span><?php echo Yii::app()->user->name;?></span></div>
      <div class="userNav">
        <ul>

          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/site/logout');?>" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
          
        </ul>
      </div>
      
      
      
      
      <?php 
	}
	else if(Yii::app()->user->isUser){
	
	?>
      <div class="welcome"><a href="<?php echo Yii::app()->createAbsoluteUrl('employee/profile');?>" title=""><img src="images/userPic.png" alt="" /></a><span><?php echo Yii::app()->user->name;?></span></div>
      <div class="userNav">
        <ul>

          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/site/logout');?>" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
          
        </ul>
      </div>
      
      
      <?php }}?>
      
   

	<!--End Top navigation bar -->
	
	
	<!--Top log area -->
	<div class="logo wrapper"></div>
	<?php  if(Yii::app()->user->isGuest){?>
	<div id="loginForm">

     <?php

	                
	                 $form=$this->beginWidget('CActiveForm', array(
	                        'id'=>'login-form',
	                		'action'=> 'index.php?r=site/login',
	                        'enableClientValidation'=>true,
	                        'clientOptions'=>array(
	                         'validateOnSubmit'=>true,8
	                        ),
	                )); 
	                
	                $loginModel = new LoginForm();
	                
	                ?>
	                
	                
	                <span class="detail"><?php echo $form->labelEx($loginModel,'username'); ?></span>
<span class="detail">  <?php echo $form->labelEx($loginModel,'password'); ?> </span>
	                
	                  <ul>
        <li>
        <?php echo $form->textField($loginModel,'username',array('class'=>'fields')); ?>
        
        </li>
        <li>
	                <?php echo $form->passwordField($loginModel,'password',array('class'=>'fields')); ?></li>
        <li> <?php echo CHtml::submitButton('Login',array('class'=>'blueBtn')); ?></li>   
    </ul>
    <span class="ele"><?php echo $form->checkBox($loginModel,'rememberMe',array('class'=>'fields')); ?></span><span class="span"><a href="#">Remember me</a></span>
    <span class="span"><a href="#">Forgot Password?</a></span>
	                  
	                
	              
	                
	                
	               
	       
	                
	                <?php 
	                        $this->endWidget(); 
	                
	                ?>
   
   
  
</div>
	<?php  }?>
	

</div> </div>
	<!--End Top log area -->
	
	
	
	<!-- Header -->
<div id="main_wrapper_161">

<div id="header" class="wrapper">

<div id="wrapper_menu"><!-- BEGIN MENU WRAPPER -->
<?php if(!Yii::app()->user->isGuest){

?>
	<!-- start employee menu  -->
	 <ul class="menu menu_black"><!-- BEGIN MENU -->
      <li class="nodrop"><a href="<?php echo Yii::app()->createAbsoluteUrl('');?>">Home</a></li>
      <!-- End Home Item --><!-- End 5 columns Item --><!-- End 4 columns Item --><!-- End 3 columns Item -->
      
      <li><a href="#" class="drop">Profile</a>
          <!-- Begin 1 column Item -->
          <div class="dropdown_1column">
            <!-- Begin 1 column container -->
            <div class="col_1 firstcolumn">
              <ul class="levels">
                <li><a href="<?php
                if(Yii::app()->user->isUser)
                    echo Yii::app()->createAbsoluteUrl('employee/profile');
                else if(Yii::app()->user->isCompany)
                echo Yii::app()->createAbsoluteUrl('company/default/profile');
                
                
                
                ?>">Profile</a></li>
                  
                  <li><a href="<?php
                if(Yii::app()->user->isUser)
                    echo Yii::app()->createAbsoluteUrl('employee/nuggetsCreator/index&hash=userDetails');
                else if(Yii::app()->user->isCompany)
                    echo Yii::app()->createAbsoluteUrl('company/default/profile');
                
                ?>">Manage</a></li>
                
              </ul>
            </div>
          </div>
          <!-- End 1 column container -->
        </li>
        
      
           <li><a class="drop" href="#">Dashboard</a>
        <!-- Begin 1 column Item -->
        <div class="dropdown_1column">
          <!-- Begin 1 column container -->
          <div class="col_1 firstcolumn">
            <ul class="levels">
            <?php if(Yii::app()->user->isUser){?>
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('utility/potentialEmployer');?>">Potential Employers</a></li>
              
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('utility/watchList');?>">Watch List</a></li>
              <?php }?>
              
              <?php if(Yii::app()->user->isCompany){?>
              <li><a href="#">Potential Candidates</a></li>
              <?php }?>
              <li><a href="#">Todo List</a></li>
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('employee/userRecomendations');?>">Recommendations</a></li>
            </ul>
          </div>
        </div>
        <!-- End 1 column container -->
      </li>


<li><a class="drop" href="#">Mailbox  <?php if(Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) >0){
	?><span class="numberTop">
	<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId());

?></span>

<?php }?></a>
        <!-- Begin 1 column Item -->
        <div class="dropdown_1column">
          <!-- Begin 1 column container -->
          <div class="col_1 firstcolumn">
            <ul class="levels">
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('message');?>">Inbox</a></li>
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('message/sent');?>">Sent Items</a></li>
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('message/inbox/draft');?>">Drafts</a></li>
            </ul>
          </div>
        </div>
        <!-- End 1 column container -->
      </li>


<li><a class="drop" href="#">Jobs</a>
        <!-- Begin 1 column Item -->
        <div class="dropdown_1column">
          <!-- Begin 1 column container -->
          <div class="col_1 firstcolumn">
            <ul class="levels">
            
            <?php if(Yii::app()->user->isCompany):?>
            
              <li><a href="<?php echo Yii::app()->createUrl('company/jobs/create');?>">Post a Job</a></li>
              <li><a class="parent" href="<?php echo Yii::app()->createUrl('company/jobs/');?>">Manage Jobs</a>
                <ul>
                  <li><a href="#">Job Management</a></li>
                </ul>
              </li>
              
              <?php endif;?>
              
              
               <?php if(Yii::app()->user->isUser):?>
            
              <li><a href="<?php echo Yii::app()->createUrl('company/jobs/');?>">Jobs</a>
                
              </li>
              
              <?php endif;?>
              
              
              
            </ul>
          </div>
        </div>
        <!-- End 1 column container -->
      </li>  
	
      <!-- End 1 column Item -->
      
 <div id="search_right">
  <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-details-form',
	'enableAjaxValidation'=>false,
		'action'=>CController::createAbsoluteUrl('/search'),
  		'htmlOptions' => array('class'=>'search'),
)); ?>
  <input type="text" class="input" id="searchGo" size="12" name="keyword">
  		<?php echo CHtml::htmlButton('Search',array('class'=>'basicBtn','type' => 'submit')); ?>
	<?php $this->endWidget(); ?>
  
</div>
     <!-- No Drop Down Item --><!-- End Contact Item -->
   </ul><!-- END MENU -->
	<!-- finished employee menu  -->
	<?php 
	
	}
	?>
</div><!-- END MENU WRAPPER -->
</div>

<!-- mainmenu -->
	
	<!-- main content start -->
	<!-- Content wrapper -->
<div class="wrapper">
<div class="content">
	<?php echo $content;?>
	<div class="fix"></div>
</div>


  </div>

	</div>
	
	

<!--<div id="footer">
  <div class="footer_wrapper"> <span>&copy; Copyright 2011. All rights reserved. Designed and Develope<a title="" href="#"> by Amerald</a></span> </div>
</div>-->

</body>
</html>
	
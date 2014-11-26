<?php

/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>




	<div id="col01">
	<div class="col-text">	
	<span class="LightWeight">Welcome</span> <span class="welcome"><?php 
        
        if(!Yii::app()->user->isGuest){
           
           echo Users::getUserName(Yii::app()->user->getId());
        } 
        
        ?></span>
	<br>
	
	[<a href="<?php echo Yii::app()->createAbsoluteUrl('/site/logout');?>">Logout</a>]
	</div>
	</div>

<div id="col02">
<div class="col-text">
<a href="">Services</a> <br>
<span class="LightWeight">Instant Response</span>
</div>
</div>
		
<p align="center">
<img src ="/images/nbp1.jpg" width="906" height="550" alt="Planets"
usemap="#planetmap">

<map name="planetmap">
<area shape="rect" coords="166,204,254,225" href="<?php echo Yii::app()->createAbsoluteUrl('/viewRiseTree');?>" alt="Sun">
<area shape="rect" coords="289,116,358,139" href="<?php echo Yii::app()->createAbsoluteUrl('/message/inbox');?>" alt="Sun">
<area shape="rect" coords="450,96,606,119" href="riseoffice.html" alt="Sun">
<area shape="rect" coords="721,118,819,141" href="<?php echo Yii::app()->createAbsoluteUrl('/bank/admin');?>" alt="Sun">
<area shape="rect" coords="748,249,892,278" href="<?php echo Yii::app()->createAbsoluteUrl('/commission/admin');?>" alt="Sun">
<area shape="rect" coords="728,379,885,407" href="riseoffice.html" alt="Sun">
<area shape="rect" coords="102,372,241,400" href="riseoffice.html" alt="Sun">







<area shape="circle" coords="128,187,38" href="<?php echo Yii::app()->createAbsoluteUrl('/viewRiseTree');?>" alt="Venus">
<area shape="circle" coords="257,102,38" href="<?php echo Yii::app()->createAbsoluteUrl('/message/inbox');?>" alt="Venus">
<area shape="circle" coords="406,88,38" href="#" alt="Venus">
<area shape="circle" coords="687,374,38" href="#" alt="Venus">
<area shape="circle" coords="705,239,38" href="<?php echo Yii::app()->createAbsoluteUrl('/commission/admin');?>" alt="Venus">
<area shape="circle" coords="687,110,38" href="<?php echo Yii::app()->createAbsoluteUrl('/bank/admin');?>" alt="Venus">
<area shape="circle" coords="167,334,38" href="<?php echo Yii::app()->createAbsoluteUrl('/users/profile');?>" alt="Venus">


</map> 


</p>


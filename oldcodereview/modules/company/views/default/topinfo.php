<div class="widget">
<div class="tab_container" id="content">
<div id="profile" class="tab_content">

<div id="profile_img">
<img width="120" height="120" src="images/avatar.png">
<a class="btnMsgLeft mt5" href="#"><img class="icon" alt="" src="images/icons/dark/adminUser.png">
<span>Send Message</span></a>

</div>
<h4 class="hset"><?php echo empty($person->companys->name)?"":$person->companys->name; ?></h4>
<p class="sub_title"><?php echo empty($person->companys->companyDetails->city)?"":$person->companys->companyDetails->city.", ".$person->companys->companyDetails->country; ?></p>
<div class="hr"></div>
<div class="profile-user-info-details"> 
<?php 
if(!empty($person->companys->industry->name)){

?>
<div class="con_left"><strong> Industry</strong></div>
<div class="info_right"><?php echo empty($person->companys->industry->name)?"":$person->companys->industry->name ?></div>
<?php 
}

if(!empty($person->companys->range->range)){

?>





		<div class="con_left"> <strong>Company Size</strong></div>
<div class="info_right">
		<?php
		echo $person->companys->range->range.' employees</div>';
		


?>
<?php }?>


<?php 
	




if(!empty($person->companys->companyDetails)){
	if(!empty($person->companys->companyDetails->website_url)){
?>



<div class="con_left"><strong> Website</strong></div>
<div class="info_right"><?php echo $person->companys->companyDetails->website_url; ?></div>



<?php }}?>

<?php 
if(Yii::app()->user->isUser){
	?>
	<form method="post" id="potential_employer-form">
	<?php echo CHtml::hiddenField('employer_id',$person->id)?>
	</form>
	<div class="con_left"><strong>Potential Employer</strong></div>
	<div class="info_right" id="potentialEmployerDiv">
	<?php 
	$criteria = new CDbCriteria();
	$criteria->compare('user_id',Yii::app()->user->id);
	$criteria->compare('employer_id',$person->id);
	$potentialEmployee = UserPotentialEmployer::model()->find($criteria);
	if(!empty($potentialEmployee)){
		echo CHtml::ajaxButton('Remove from Potential Employer', $this->createAbsoluteUrl('potentialEmployerRemove'),
						array('update'=>'#potentialEmployerDiv','data'=>'js:$("#potential_employer-form").serialize()'), array('class'=>'greenBtn','id'=>'potentialEmployebtn'));
	
	}
	
	else{
		echo CHtml::ajaxButton('Add to Potential Employer', $this->createAbsoluteUrl('potentialEmployerAdd'),
				array('update'=>'#potentialEmployerDiv','data'=>'js:$("#potential_employer-form").serialize()'), array('class'=>'greenBtn','id'=>'potentialEmployebtn'));
		
	}
}


?>

</div>
</div>
</div>
<div class="fix"></div>
</div>


<div class="nugget">
      <!-- Main Nugget Info Div -->
          <div class="nugget_info">





<?php 

$nuggets = AkimboNuggetManager::getAllCompanyNuggets();
?>


       
<?php foreach($details as $key=>$detailArray){
	
	echo '<div class="nugget_heading mt20">';
	echo '<span class="';
	if(isset($nuggets[$key])){
		echo $nuggets[$key]['span'];
	}
	
	echo '"></span>';
	echo '<h2>';
	if(isset($nuggets[$key])){
		echo $nuggets[$key]['title'];
		
	}
	echo '</h2>';
	echo '</div>';
	foreach ($detailArray as $detail){
	
	?>

	 <!--Nugget info start -->
      	  <div class="ndata bbot">    
          <div class="info_heading"><h4><span><?php echo $detail['title'];?></span> <?php echo $detail['organization'];?></h4></div>
          <div class="right_mini_info"><?php echo $detail['date'];?></div>
          <div class="description"><?php echo $detail['description'];?>.</div>
          <div class="fix"></div>
          </div>  <!--Nugget info end -->
	
	
	

<?php }}?>






<div class="fix"></div>
</div>
<div class="widgets"> </div>
</div>



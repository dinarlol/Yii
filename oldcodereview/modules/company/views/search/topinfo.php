<div class="widget">
<div class="tab_container" id="content">
<div id="profile" class="tab_content">
<div id="profile_img">
<img width="120" height="120" src="images/avatar.png">
<a class="btnMsgLeft mt5" href="#"><img class="icon" alt="" src="images/icons/dark/adminUser.png">
<span>Send Message</span></a>

</div>
<h4 class="hset"><?php echo $person->userDetails->first_name." ".$person->userDetails->last_name; ?></h4>
<p class="sub_title"><?php echo $person->userDetails->city.", ".$person->userDetails->country; ?></p>
<div class="hr"></div>
<div class="profile-user-info-details"> 
<?php 
if(!empty($person->userAcademics[0])){

?>
<div class="con_left"><strong> Education</strong></div>
<div class="info_right"><?php echo $person->userAcademics[0]->school.", ".$person->userAcademics[1]->school; ?></div>
<?php 
}
$website ='';
if(!empty($person->userWorkExperiences)){

?>

<div class="con_left"> <strong>Current Employment</strong></div>
<div class="info_right">


<?php 

foreach($person->userWorkExperiences as $workexperience){
	
	if($workexperience->is_working){
		
		$website = $workexperience->website_url;
		echo $workexperience->organization.'</div>';
	}
	
}

}
?>



<div class="con_left"><strong> Website</strong></div>
<div class="info_right"><?php echo $website; ?></div>


</div>
</div>
</div>
<div class="fix"></div>


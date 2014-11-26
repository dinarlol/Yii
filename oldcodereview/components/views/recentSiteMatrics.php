  <?php 
  
  $person = $this->getPersonForSiteMatrics();
  
  ?>
  
  <!-- Site Matrics widget -->
  <div class="widget">
    <div class="head">
      <h5 class="iGraph">Site Matrics</h5>
      
         <?php 
        
        if($person->profile_visits_count > 0){
       
        	
        	?>
        <div class="num"><a class="redNum" href="<?php echo $this->createAbsoluteUrl('/matrics')?>">+<?php echo $person->profile_visits_count; ?></a></div>
        <?php }?>
      
      
    </div>
    
    <?php 
    
  //  $person->ownerSiteMatric->group = $person->id;
//    print_R($person->ownerSiteMatric);exit;
    $time_utility = new Time();
    foreach ($person->ownerSiteMatric as $keys=>$sitematric){
    //print_r($sitematric);exit;

    ?>
    
    <div class="supTicket nobg">
      <div class="issueSummary"> <a class="floatleft" title="" href="#"><img alt="" src="images/icons/dark/user.png" class="reset_thumb"></a>
        <div class="ticketInfo">
          <ul>
            <li>
            <?php

            if($sitematric->visitor->role->name == $sitematric->visitor->userRole){
            	
           echo '<a href="'.$this->createAbsoluteUrl('/employee/profile',array('id'=>$sitematric->visitor->id)).'">';
            echo $sitematric->visitor->userDetails->first_name;
            echo '</a> ';
            }
            else if($sitematric->visitor->role->name == $sitematric->visitor->companyRole){
            	echo '<a href="'.$this->createAbsoluteUrl('/company/default/profile',array('id'=>$sitematric->visitor->id)).'">';
            echo $sitematric->visitor->companys->name;
            echo '</a> ';
            }
            
            ?><?php echo $sitematric->activity->description;?>
            
             <?php echo " ".EmployeeProfile::getProfileViewCountByVisitorId($sitematric->owner_user_id, $sitematric->visitor_user_id)?> time in last 
              <?php  echo $time_utility->timeAgoInWords($sitematric->create_date,array('endString'=>''));?> from
              <img width="11" height="11" class="reset_img" src="images/icons/dark/pin.png"><a href="#"> <?php echo $sitematric->location;?></a>.
            </li>
          
          </ul>
          <div class="fix"></div>
        </div>
        <div class="fix"></div>
      </div>
    </div>
    
    
    
    
    
    <?php }?>
    
     <div class="supTicket nobg">
        <div class="issueSummary"> 
          <div class="ticketInfo">
            <ul>
            
                        <li class="right">
                        
                        <a class="green_nor" href="<?php echo $this->createAbsoluteUrl('/matrics')?>">Read more</a></li>
            
            
            
            </ul>
            <div class="fix"></div>
          </div>
          <div class="fix"></div>
        </div>
      </div>
    
    
   
      </div>   
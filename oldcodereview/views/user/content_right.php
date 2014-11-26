<div id="content_right"> 
  
  <!-- Right widgets -->
  <div class="right"> 
    
    <!-- Photos, Videos Tab -->
             <div class="widget">       
                    <ul class="tabs">
                        <li><a href="#tab1">Photos</a></li>
                        <li><a href="#tab2">Videos</a></li>
                        <li><a href="#tab2">Docs</a></li>
                    </ul>
                    
                    <div class="tab_container">
                        <div class="tab_content" id="tab1">This tab is active</div>
                        <div class="tab_content" id="tab2"> This tab is active now</div>
                        <div class="tab_content" id="tab3"> This tab is active now</div>
                    </div>	
                    <div class="fix"></div>		 
                </div>

    
    
    <!-- Recommnedations widget -->
    <div class="widget">
      <div class="head">
        <h5 class="iHelp">Recomendations</h5>
        <?php 
        
        // for users only
        
        if(Yii::app()->user->isUser){
        
        if(!empty($count)){
       
        	
        	?>
        <div class="num"><a class="redNum" href="<?php echo $this->createAbsoluteUrl('/employee/userRecomendations')?>">+<?php echo $count; ?></a></div>
        <?php }?>
      </div>
      
      <!-- start user recomendation loop -->
      <?php if(!empty($recomendation)){
      	
      //	print_r($recomendation);exit;
      $currentSector = '';	
      $sector = '';
      	foreach ($recomendation as $recomend){
      	?>
      
      <div class="supTicket nobg">
        <div class="issueSummary"> <a class="floatleft" href="#"><img class="reset_thumb" src="images/icons/dark/star.png"></a>
          <div class="ticketInfo">
            <ul>
            
            <?php if($recomend->recomender->role->name == $recomend->recomender->userRole){?>
              <li><a href="<?php echo $this->createAbsoluteUrl('/employee/profile',array('id'=>$recomend->recomender->id,'category'=>$recomend->category->name))?>"> <?php echo $recomend->recomender->userDetails->first_name;?> </a>
               Recomended <a href="#"> <?php echo $recomend->user->userDetails->first_name; ?> </a>for<a href="<?php echo $this->createAbsoluteUrl('/employee/profile',array('category'=>$recomend->category->name))?>"> <?php echo $recomend->category->description;?> Category </a></li>
            <?php }?>
            
            
            <?php if($recomend->recomender->role->name == $recomend->recomender->companyRole){?>
              <li><a href="<?php echo $this->createAbsoluteUrl('/company/default/profile',array('id'=>$recomend->recomender->id,'category'=>$recomend->category->name))?>"> <?php echo $recomend->recomender->companys->name;?> </a>
               Recomended <a href="#"> <?php echo $recomend->user->userDetails->first_name; ?> </a>for<a href="<?php echo $this->createAbsoluteUrl('/employee/profile',array('category'=>$recomend->category->name))?>"> <?php echo $recomend->category->description;?> Category </a></li>
            <?php }?>
            
            
            
            
             
              <li class="right"><span class="green"><?php 
              $time_utility = new Time();
              
              echo $time_utility->timeAgoInWords($recomend->create_date);?></span></li>
            </ul>
            <div class="fix"></div>
          </div>
          <div class="fix"></div>
        </div>
      </div>
 <?php }}?>
 
  
  
  
  <div class="supTicket nobg">
        <div class="issueSummary"> 
          <div class="ticketInfo">
            <ul>
            
                        <li class="right">
                        
                        <a class="green_nor" href="<?php echo $this->createAbsoluteUrl('/employee/userRecomendations')?>">See all recommendations</a></li>
            
            
            
            </ul>
            <div class="fix"></div>
          </div>
          <div class="fix"></div>
        </div>
      </div>
  
  
  
  
  <!-- end loop for user recomendation details -->
 
 <?php 
 
 
        } // end for users recomendation
 ?>
    </div>
    
     <!-- END Recommnedations widget -->
  </div>
  
  <!-- Site Matrics widget -->
  <div class="widget">
    <div class="head">
      <h5 class="iGraph">Site Matrics</h5>
      
         <?php 
        
        if($person->profile_visits_count > 0){
       
        	
        	?>
        <div class="num"><a class="redNum" href="<?php echo $this->createAbsoluteUrl('/employee/userRecomendations')?>">+<?php echo $person->profile_visits_count; ?></a></div>
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
      <div class="issueSummary"> <a class="floatleft" title="" href="#"><img alt="" src="images/icons/dark/user.png"></a>
        <div class="ticketInfo">
          <ul>
            <li>
            <?php

            if($sitematric->visitor->role->name == $sitematric->visitor->userRole){
            	
           echo '<a href="'.$this->createAbsoluteUrl('/employee/profile',array('id'=>$sitematric->visitor->id)).'">';
            echo $sitematric->visitor->userDetails->first_name;
            echo '</a>';
            }
            else if($sitematric->visitor->role->name == $sitematric->visitor->companyRole){
            	echo '<a href="'.$this->createAbsoluteUrl('/company/default/profile',array('id'=>$sitematric->visitor->id)).'">';
            echo $sitematric->visitor->companys->name;
            echo '</a>';
            }
            
            ?><?php echo $sitematric->activity->description;?>
            
             <?php echo " ".EmployeeProfile::getProfileViewCountByVisitorId($sitematric->owner_user_id, $sitematric->visitor_user_id)?> time in last 
              <?php  echo $time_utility->timeAgoInWords($sitematric->create_date,array('endString'=>''));?> from
              <div><img width="11" height="11" class="reset_img" src="images/icons/dark/pin.png"><a href="#"> <?php echo $sitematric->location;?></a>.</div>
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
      
<!-- Right Column End -->     
</div>
 <?php
 $recommendation = $this->getRecomendations();
 $count = $this->count;
 ?>
 
    <!-- Recommnedations widget -->
    <div class="widget">
      <div class="head">
        <h5 class="iHelp">Job Recomendations</h5>
        <?php 
        
        // for users only
        
        if(Yii::app()->user->isCompany){
        
        if(!empty($count)){
       
        	
        	?>
        <div class="num"><a class="redNum" href="<?php echo $this->createAbsoluteUrl('/employee/userRecomendations')?>">+<?php echo $count; ?></a></div>
        <?php }?>
      </div>
      
      <!-- start user recommendation loop -->
      <?php if(!empty($recommendation)){
      	
      //	print_r($recommendation);exit;
      $currentSector = '';	
      $sector = '';
      	foreach ($recommendation as $recommend){
      	?>
      
      <div class="supTicket nobg">
        <div class="issueSummary"> <a class="floatleft" href="#"><img class="reset_thumb" src="images/icons/dark/star.png"></a>
          <div class="ticketInfo">
            <ul>
            
            <?php if($recommend->user->role->name == $recommend->user->userRole){?>
              <li><a href="<?php echo $this->createAbsoluteUrl('/employee/profile',array('id'=>$recommend->user->id))?>"> <?php echo $recommend->recommender_name;?> </a>
               Recomended <a href="#"> <?php echo $recommend->recommender_name; ?> </a>for<a href="<?php echo $this->createAbsoluteUrl('/employee/profile',array('id'=>$recommend->user->id))?>"> <?php echo $recommend->job->job_title;?> Job </a></li>
            <?php }?>
            
            
            <?php if($recommend->user->role->name == $recommend->user->companyRole){?>
              <li><a href="<?php echo $this->createAbsoluteUrl('/company/default/profile',array('id'=>$recommend->user->id))?>"> <?php echo $recommend->user->companys->name;?> </a>
               Recomended <a href="#"> <?php echo $recommend->recommender_name; ?> </a>for<a href="<?php echo $this->createAbsoluteUrl('/company/default/profile',array('id'=>$recommend->user->id))?>"> <?php echo $recommend->job->job_title;?> Job </a></li>
            <?php }?>
            
            
            
            
             
              <li class="right"><span class="green"><?php 
              $time_utility = new Time();
              
              echo $time_utility->timeAgoInWords($recommend->create_date);?></span></li>
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
                        
                        <a class="green_nor" href="<?php echo $this->createAbsoluteUrl('/company/jobRecomendations')?>">See all recommendations</a></li>
            
            
            
            </ul>
            <div class="fix"></div>
          </div>
          <div class="fix"></div>
        </div>
      </div>
  
  
  
  
  <!-- end loop for user recommendation details -->
 
 <?php 
 
 
        } // end for users recommendation
 ?>
    </div>
    
     <!-- END Recommnedations widget -->
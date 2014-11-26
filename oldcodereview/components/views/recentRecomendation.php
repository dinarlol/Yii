 <?php
 $recomendation = $this->getRecomendations();
 $count = $this->count;
 ?>
 
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
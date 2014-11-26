<?php $person = $this->getPersonForRecentNewsUpdates();?>



<div class="widget">
 <div class="head">
        <h5 class="iTv">News &amp; Updates</h5>
 </div>
    <div class="tab_container">
      <div class="tab_content" id="tab3">
      
      <?php if(!empty($person->potential_employer)):?>

      <ul>
      
      <?php foreach ($person->potential_employer as $potential_employer):?>
      
           
      <?php if(!empty($potential_employer->potential_employer)):?>
  
     
      <?php foreach ($potential_employer->potential_employer->jobs as $job):?>
      
      <li><span class="add"></span><span><span class="name"><?php echo $potential_employer->potential_employer->companys->name;?></span> post new job <?php echo $job->job_title?></span></li>
    
      <?php endforeach;?>
      
      <?php endif;?>
      <?php endforeach;?>
      
      </ul>
      
      <?php endif;?>
      
      
      </div>
      <div class="fix"></div>
    </div>
    

    <!-- Widgets -->
    <div class="widgets"> </div>
  </div>
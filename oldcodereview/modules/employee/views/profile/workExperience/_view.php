<?php
$startDate = new DateTime($data->start_date); 
$endDate = new DateTime($data->end_date); 

?>
<div class="ndata bbot">    
          <div class="info_heading"><h4><?php echo CHtml::encode($data->title); ?> <span class="grey">at</span>
                  <span class="red"> <?php echo CHtml::encode($data->organization); ?></span></h4></div>
                                    
    <div class="right_mini_info"><?php echo $startDate->format("Y-m-d"); ?>&ndash; 
                                <?php if($data->is_working) echo "Present"; else echo $endDate->format("Y-m-d");?> </div>
        <div class="description"><?php echo CHtml::encode($data->job_duty); ?></div>
    
    <div class="fix"></div>
</div>





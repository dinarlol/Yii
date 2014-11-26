<?php 
$graduation_date = new DateTime($data->graduation_date); 
?>
<div class="ndata bbot">
    <div class="info_heading">
        <h4><?php echo CHtml::encode($data->school); ?> <small><?php echo CHtml::encode($graduation_date->format("Y-m-d")); ?></small></h4>
        
    </div>
      
    <div class="major">Major: <?php echo CHtml::encode($data->major_subject_id); ?></div>
    <br />
    <div class="minor">Minor: <?php echo CHtml::encode($data->minor_subject_id); ?></div>
    <br />
    <div class="minor">Concentration: <?php echo CHtml::encode(UserEducationTitle::model()->findByPk($data->concentration)->name) ; ?></div>
    <br />
    <div class="minor">GPA: <?php echo CHtml::encode($data->gpa); ?></div>
    
    <div class="fix"></div>
   
  
</div>
<?php 
$hobbies = UserHobbies::model()->findAll("user_id = :user_id", array(":user_id"=>$data->user_id)); 
$lookingfor = UserLookingFor::model()->findAll("user_id = :user_id", array(":user_id"=>$data->user_id));
?>
<div class="ndata bbot">
    <div class="description_full"><?php echo CHtml::encode($data->objective); ?></div>
    
   <?php  if(count($hobbies)>0): ?>
       <div class="interest">
          <h5>Interest</h5>
          	<ul><?php foreach($hobbies as $hobbyRow){
                    echo "<li>".$hobbyRow->name."</li>";
                }?></ul>
        </div>
       
   <?php endif;?>
    
    <?php  if(count($lookingfor)>0): ?>
       <div class="industry">
          <h5>Industry</h5>
          	<ul><?php foreach($lookingfor as $lookingforRow){
                    echo "<li>".CHtml::encode(Industry::model()->findByPk($lookingforRow->industry_id)->name)."</li>";
                }?></ul>
        </div>
       
   <?php endif;?>
  

</div>
<div class="fix"></div>
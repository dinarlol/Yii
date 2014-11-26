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
    <div class="buttonrow">
       <?php      
              echo CHtml::ajaxLink("Edit", Yii::app()->createUrl("employee/aboutMe/update&id=".$data->id),
                        array('type' =>'POST','update' => '#operationResultDiv','dataType' => 'html'),
                        array("id"=>"btnedit".$data->id,"class"=>"input fright button"));
              echo "&nbsp;";
              
              echo CHtml::link(
                'Delete',
                '#',
                array('submit'=>Yii::app()->createUrl("employee/aboutMe/delete",array("id"=>$data->id)),
                'params'=>array('returnUrl'=>  Yii::app()->createUrl("employee/nuggetsCreator/index",
                 array("hash"=>"aboutMe"))), 
                    'confirm' => 'Are you sure?',
                    "id"=>"btndelete",
                    "class"=>"input fright button"
                ));
               

        ?>
        
    </div>

</div>
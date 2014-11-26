<?php 
$graduation_date = new DateTime($data->graduation_date); 
?>
<div class="ndata bbot">
    <div class="info_heading">
        <h2><?php echo CHtml::encode($data->school); ?> <small><?php echo CHtml::encode($graduation_date->format("Y-m-d")); ?></small></h2>
        
    </div>
      
    <div class="major">Major: <?php echo CHtml::encode($data->major_subject_id); ?></div>
    <br />
    <div class="minor">Minor: <?php echo CHtml::encode($data->minor_subject_id); ?></div>
    <br />
    <div class="minor">Concentration: <?php echo CHtml::encode(UserEducationTitle::model()->findByPk($data->concentration)->name) ; ?></div>
    <br />
    <div class="minor">GPA: <?php echo CHtml::encode($data->gpa); ?></div>
    
    <div class="fix"></div>
   
    <div class="buttonrow">
 <?php      
               echo CHtml::ajaxLink("Edit", Yii::app()->createUrl("employee/academics/update&id=".$data->id),
                        array('type' =>'POST','update' => '#operationResultDiv','dataType' => 'html'),
                          array("id"=>"btnedit".$data->id,"class"=>"input fright button"));
             
               
               echo CHtml::link(
                'Delete',
                '#',
                array('submit'=>Yii::app()->createUrl("employee/academics/delete",array("id"=>$data->id)),
                'params'=>array('returnUrl'=>  Yii::app()->createUrl("employee/nuggetsCreator/index",array("hash"=>"academic"))), 
                    'confirm' => 'Are you sure?','id'=>'del'.$data->id, "class"=>"input fright button",
                ));
                    

        ?>
        
    </div>
</div>
<?php
$startDate = new DateTime($data->start_date);
$startDate = $startDate->format("Y-m");

$endDate = new DateTime($data->end_date);
$endDate = $endDate->format("Y-m");
?>

<div class="ndata bbot">
   

   <div class="oneline"> 

    <div class="heading1">
    <?php echo CHtml::encode($data->getAttributeLabel('organization')); ?></div><h4><?php echo CHtml::encode($data->organizations->name); ?></h4>
    <div class="right_small_info"><?php echo CHtml::encode($startDate); ?> &ndash; <?php echo CHtml::encode($endDate); ?></div>

    </div>

     <div class="heading1"><?php echo CHtml::encode($data->getAttributeLabel('cause')); ?></div>
    <div class="ncontent"><?php echo CHtml::encode($data->cause); ?></div>

     <div class="space"></div>
     <div class="heading1"><?php echo CHtml::encode($data->getAttributeLabel('impact')); ?></div>
     <div class="ncontent"><?php echo CHtml::encode($data->impact); ?></div>

<div class="space"></div>
     <div class="heading1"><?php echo CHtml::encode($data->getAttributeLabel('mycauses')); ?></div>
     <div class="ncontent"><?php echo CHtml::encode($data->mycauses); ?></div>
    <div class="fix"></div>

    <div class="heading1"></div>
    <div class="uploadwork">
            <div></div>
            <div></div>
            <div></div> 
            
            </div>
<div class="fix"></div>
</div>

<div class="buttonrow" >
   	<?php      
              echo CHtml::ajaxLink("Edit", Yii::app()->createUrl("employee/volunteerisms/update&id=".$data->id),
                        array('type' =>'POST','update' => '#operationResultDiv','dataType' => 'html'),
                        array("id"=>"btnedit".$data->id,"class"=>"input fright button"));
             
              echo "&nbsp;";
              
              echo CHtml::link('Delete','#',array('submit'=>Yii::app()->createUrl("employee/volunteerisms/delete",array("id"=>$data->id)),
                'params'=>array('returnUrl'=>  Yii::app()->createUrl("employee/nuggetsCreator/index",array("hash"=>"volunteerisms"))), 
                    'confirm' => 'Are you sure?',
                  'id'=>'del'.$data->id,
                   "class" =>"input fright button"
                )
                  
                );
                    

        ?>
    </div>
<div class="fix"></div>

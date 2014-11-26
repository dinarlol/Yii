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

<div class="buttonrow">
        <!--<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id));
            echo CHtml::link(CHtml::encode('Detail'), array('view', 'id'=>$data->id));
        ?>
	<br />-->
            <?php      
              echo CHtml::ajaxLink("Edit", Yii::app()->createUrl("employee/workExperience/update&id=".$data->id),
                        array('type' =>'POST','update' => '#operationResultDiv','dataType' => 'html'),
                        array("id"=>"btnedit".$data->id,"class"=>"input fright button"));
             
              echo "&nbsp;";
              echo CHtml::link(
                        'Delete',
                        '#',
                        array('submit'=>Yii::app()->createUrl("employee/workExperience/delete",array("id"=>$data->id)),
                        'params'=>array('returnUrl'=>  Yii::app()->createUrl("employee/nuggetsCreator/index",array("hash"=>"workExperience"))), 
                            'confirm' => 'Are you sure?','id'=>'del'.$data->id, "class"=>"input fright button",
               ));
                    

        ?>
        

</div>



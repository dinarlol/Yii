<div class="ndata bbot">
    <div class="info_heading">
                 <h4>
                 <span class="lable"><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</span> <span class="put"><?php echo CHtml::encode(MilitaryServiceBranch::model()->findByPk($data->branch_id)->name); ?></span>
                 <span class="lable"><?php echo CHtml::encode($data->getAttributeLabel('devision')); ?>:</span> <span class="put"> <?php echo CHtml::encode($data->devision); ?></span>
                 <span class="lable"><?php echo CHtml::encode($data->getAttributeLabel('rank')); ?>:</span><span class="put"> <?php echo CHtml::encode($data->rank); ?></span></h4>
           </div><br />
    <div class="buttonrow">
	

	
        <?php      
              echo CHtml::ajaxLink("Edit", Yii::app()->createUrl("employee/militaryServices/update&id=".$data->id),
                        array('type' =>'POST','update' => '#operationResultDiv','dataType' => 'html'),
                        array("id"=>"btnedit".$data->id,"class"=>"input fright button"));
              
             
              echo "&nbsp;&nbsp;";
              echo CHtml::link(
                'Delete',
                '#',
                array('submit'=>Yii::app()->createUrl("employee/militaryServices/delete",array("id"=>$data->id)),
                'params'=>array('returnUrl'=>  Yii::app()->createUrl("employee/nuggetsCreator/index",array("hash"=>"militaryService"))), 
                    'confirm' => 'Are you sure?',
                    "id"=>"btndel".$data->id,
                    "class"=>"input fright button",
                ));
                    

        ?>
    </div>


</div>
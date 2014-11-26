<div class="ndata bbot">
    <div class="info_heading">
                 <h4>
                 <span class="lable"><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</span> <span class="put"><?php echo CHtml::encode(MilitaryServiceBranch::model()->findByPk($data->branch_id)->name); ?></span>
                 <span class="lable"><?php echo CHtml::encode($data->getAttributeLabel('devision')); ?>:</span> <span class="put"> <?php echo CHtml::encode($data->devision); ?></span>
                 <span class="lable"><?php echo CHtml::encode($data->getAttributeLabel('rank')); ?>:</span><span class="put"> <?php echo CHtml::encode($data->rank); ?></span></h4>
           </div><br />



</div>
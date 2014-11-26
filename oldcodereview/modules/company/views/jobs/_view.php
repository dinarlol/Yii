<?php 
$publishing_date = new DateTime($data->job_publishing_date);
$publishing_date = $publishing_date->format("M/d/Y");

$expiredate_date = new DateTime($data->job_expiredate);
$expiredate_date = $expiredate_date->format("M/d/Y");
?>
<div class="view">
	     
	<b><?php echo CHtml::encode($data->getAttributeLabel('job_title')); ?>:</b>
	<?php echo CHtml::encode($data->job_title); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('job_category_id')); ?>:</b>
	<?php //echo CHtml::encode($data->job_category_id); 
            echo CHtml::encode(JobCategory::model()->findByPk($data->job_category_id)->name);
        ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_of_post')); ?>:</b>
	<?php echo CHtml::encode($data->number_of_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_publishing_date')); ?>:</b>
	<?php echo CHtml::encode($publishing_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_expiredate')); ?>:</b>
	<?php echo CHtml::encode($expiredate_date); ?>
	<br />
        
        <b>Views: </b>Total <?php echo JobViewStats::model()->count("job_post_id = :job_post_id", array(":job_post_id"=>$data->id)); ?>
        <br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('job_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_description')); ?>:</b>
	<?php echo CHtml::encode($data->job_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->job_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	*/ ?>
        
        <?php
        echo CHtml::link("Manage", Yii::app()->createUrl("company/jobs/view",array("id"=>$data->id)), 
                array("id"=>"viewstats".$data->id)); 
             
        echo "&nbsp; | &nbsp;";
               
        echo CHtml::link(
                'Delete',
                '#',
                array('submit'=>Yii::app()->createUrl("company/jobs/delete",array("id"=>$data->id)),
                'params'=>array('returnUrl'=>  Yii::app()->createUrl("company/jobs/index")), 
                    'confirm' => 'Are you sure?','id'=>'del'.$data->id,
                ));
        ?>
        
        <?php echo CHtml::htmlButton('Recomend',array('class'=>'greenBtn','type' => 'submit','onclick'=>'$("#job-recomendations-dialog").dialog("open");$("#job_id").val('.$data->id.'); return false;')); ?>
        

</div>


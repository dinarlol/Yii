
<p><?php 
echo CHtml::link("Edit",Yii::app()->createUrl("company/managePost/update&id=".$model->id), array("id"=>"btnedit".$model->id)); 
echo CHtml::link(
		'Delete',
		'#',
		array('submit'=>Yii::app()->createUrl("company/managePost/delete",array("id"=>$model->id)),
				'params'=>array('returnUrl'=>  Yii::app()->createUrl("company/managePost/index")),
				'confirm' => 'Are you sure?','id'=>'del'.$model->id,
		));

?>
</p>

<p>
<h6>Job Title: </h6>
<?php echo $model->getAttribute('job_title');?>
<h6>Category: </h6>
<?php echo $model->jobCategory->name; ?>
<h6>No of Post: </h6>
<?php echo $model->number_of_post; ?>
<h6>Experience required: </h6>
<?php foreach($model->PostJobRequirement as $req){
    echo $req->experience; 
}
?>
<?php if(!is_null($jobStats) && count($jobStats)>0){ ?>
<table border="1" cellspacing="0" cellpadding="10" width="900">
    <thead><tr><th align="left">First Name</th><th align="left">Last Name</th>
            <th align="left">Apply Date</th><th align="left">&nbsp;</th><th align="left">&nbsp;</th></tr></thead>
    <tbody>
     <?php foreach($jobStats as $stats): ?>   
        <tr <?php echo ($stats->visited) ? "style='background:gray; color:white'" : ""?>>
            <td><?php echo UserDetails::model()->find("user_id = :user_id", array(":user_id"=>$stats->user_id))->first_name; ?></td>
            <td><?php echo UserDetails::model()->find("user_id = :user_id", array(":user_id"=>$stats->user_id))->last_name; ?></td>
            <td><?php echo $stats->visitdate ; ?></td>
            <td><?php //echo CHtml::link("View Profile", Yii::app()->createUrl("employee/profile", array("id"=>$stats->user_id)), array("id"=>"vp".$stats->id)); 
            echo CHtml::link('View Profile','#',array('submit'=>Yii::app()->createUrl("company/managePost/visitProfile",
                        array("jobPostId"=>$stats->id,"user_id"=>$stats->user_id)),
                'params'=>array('returnUrl'=>  Yii::app()->createUrl("employee/profile",array("id"=>"151"))),
                ));
            
            ?></td>
            <td><?php echo CHtml::dropDownList('decision', $stats->application_status, array("ACCEPTED"=>"Short List","REJECTED"=>"REJECTED"),
                      array('empty'=>'Action',"onchange"=>"acceptApplicant(this,
                      '".Yii::app()->createUrl("company/managePost/applicationStatus",
                      array("statsId"=>$stats->id))."','')" )); 
            ?></td>
        </tr>
        
     <?php endforeach; ?>
    </tbody>
</table>
<?php }else{ ?>
<div>No replies against it</div>
<?php } ?>
</p>




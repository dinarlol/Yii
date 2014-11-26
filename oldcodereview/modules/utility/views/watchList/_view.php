<div class="view">
<p>
	<b><?php echo CHtml::encode($data->job->jobCategory->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->job->jobCategory->name); ?>
	<br />
	
	
	
	<b><?php echo CHtml::encode($data->job->getAttributeLabel('job_title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->job->job_title),$this->createAbsoluteUrl('/company/jobs/view', array('id'=>$data->job->id))); ?>
	<br />

	<b><?php echo CHtml::encode($data->job->getAttributeLabel('job_description')); ?>:</b>
	<?php echo CHtml::encode($data->job->job_description); ?>
	<br />
	
<b><?php echo CHtml::encode($data->job->getAttributeLabel('job_expiredate')); ?>:</b>
	<?php echo CHtml::encode($data->job->job_expiredate); ?>
	<br />
	
	</p>
	

</div>
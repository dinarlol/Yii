<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_group_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommender_id')); ?>:</b>
	<?php echo CHtml::encode($data->recommender_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('show')); ?>:</b>
	<?php echo CHtml::encode($data->show); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommender_name')); ?>:</b>
	<?php echo CHtml::encode($data->recommender_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommender_current_position')); ?>:</b>
	<?php echo CHtml::encode($data->recommender_current_position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommender_email')); ?>:</b>
	<?php echo CHtml::encode($data->recommender_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	*/ ?>

</div>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upload_work')); ?>:</b>
	<?php echo CHtml::encode($data->upload_work); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relevant_business_projects')); ?>:</b>
	<?php echo CHtml::encode($data->relevant_business_projects); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ventures')); ?>:</b>
	<?php echo CHtml::encode($data->ventures); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inspiredby')); ?>:</b>
	<?php echo CHtml::encode($data->inspiredby); ?>
	<br />

	*/ ?>

</div>
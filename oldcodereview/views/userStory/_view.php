<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('story')); ?>:</b>
	<?php echo CHtml::encode($data->story); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quote')); ?>:</b>
	<?php echo CHtml::encode($data->quote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inspiration')); ?>:</b>
	<?php echo CHtml::encode($data->inspiration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('impact')); ?>:</b>
	<?php echo CHtml::encode($data->impact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	*/ ?>

</div>
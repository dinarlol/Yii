<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upload')); ?>:</b>
	<?php echo CHtml::encode($data->upload); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inspiredby')); ?>:</b>
	<?php echo CHtml::encode($data->inspiredby); ?>
	<br />


</div>
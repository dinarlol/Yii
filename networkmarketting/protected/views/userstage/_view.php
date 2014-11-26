<?php
/* @var $this UserstageController */
/* @var $data Userstage */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userstage_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userstage_id), array('view', 'id'=>$data->userstage_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />


</div>
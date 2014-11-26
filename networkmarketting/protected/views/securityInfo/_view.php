<?php
/* @var $this SecurityInfoController */
/* @var $data SecurityInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('security_quest_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->security_quest_id), array('view', 'id'=>$data->security_quest_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('security_quest')); ?>:</b>
	<?php echo CHtml::encode($data->security_quest); ?>
	<br />


</div>
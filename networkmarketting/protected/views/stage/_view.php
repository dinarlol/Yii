<?php
/* @var $this StageController */
/* @var $data Stage */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('stage_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->stage_id), array('view', 'id'=>$data->stage_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stage')); ?>:</b>
	<?php echo CHtml::encode($data->stage); ?>
	<br />


</div>
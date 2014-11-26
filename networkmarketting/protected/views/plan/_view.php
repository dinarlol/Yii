<?php
/* @var $this PlanController */
/* @var $data Plan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('plan_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->plan_id), array('view', 'id'=>$data->plan_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plan')); ?>:</b>
	<?php echo CHtml::encode($data->plan); ?>
	<br />


</div>
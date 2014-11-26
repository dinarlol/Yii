<?php
/* @var $this PaymentController */
/* @var $data Payment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_type_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->payment_type_id), array('view', 'id'=>$data->payment_type_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_type')); ?>:</b>
	<?php echo CHtml::encode($data->payment_type); ?>
	<br />


</div>
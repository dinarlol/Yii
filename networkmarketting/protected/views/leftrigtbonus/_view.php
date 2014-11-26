<?php
/* @var $this LeftrigtbonusController */
/* @var $data Leftrigtbonus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('bonus_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->bonus_id), array('view', 'id'=>$data->bonus_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('left_id')); ?>:</b>
	<?php echo CHtml::encode($data->left_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('right_id')); ?>:</b>
	<?php echo CHtml::encode($data->right_id); ?>
	<br />


</div>
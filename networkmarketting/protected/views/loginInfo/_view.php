<?php
/* @var $this LoginInfoController */
/* @var $data LoginInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('username_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->username_id), array('view', 'id'=>$data->username_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_id')); ?>:</b>
	<?php echo CHtml::encode($data->role_id); ?>
	<br />


</div>
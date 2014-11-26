<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userbank_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userbank_id),array('view','id'=>$data->userbank_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('points')); ?>:</b>
	<?php echo CHtml::encode($data->points); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_type')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	


</div>
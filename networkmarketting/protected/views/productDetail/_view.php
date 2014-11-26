<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_detail_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->product_detail_id),array('view','id'=>$data->product_detail_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_detail')); ?>:</b>
	<?php echo CHtml::encode($data->product_detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />


</div>
<?php
/* @var $this IntroducerController */
/* @var $data Introducer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('introducer_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->introducer_id), array('view', 'id'=>$data->introducer_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('introducer')); ?>:</b>
	<?php echo CHtml::encode($data->introducer); ?>
	<br />


</div>
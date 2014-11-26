<div class="ndata bbot">

	<b><?php echo CHtml::encode($data->company->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->company->name), array('view', 'id'=>$data->id)); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_info')); ?>:</b>
	<?php echo CHtml::encode($data->company_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website_url')); ?>:</b>
	<?php echo CHtml::encode($data->website_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	 
	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street')); ?>:</b>
	<?php echo CHtml::encode($data->street); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zip')); ?>:</b>
	<?php echo CHtml::encode($data->zip); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo')); ?>:</b>
	
	<br />
	
	<?php 
	
	if(!empty($data->photo_uploader)){
		
	
			echo CHtml::link(
					'Remove Logo', array('deleteImage','id'=>$data->photo_uploader->id),
					array('confirm' => 'Are you sure?','id' =>uniqid('akb_')));
			echo CHtml::image(Yii::app()->baseUrl.$data->photo_uploader->location.$data->photo_uploader->name,$data->photo_uploader->name,array('class'=>'avatar','width'=>'130','height'=>'140'));
	
	
	
	
			echo CHtml::encode($data->photo_uploader->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->photo_uploader->name); ?>
	<br />
	
	<?php }
	
	
	
	
	?>

  <div class="buttonrow">
    <?php 

echo CHtml::ajaxLink('Edit', $this->createAbsoluteUrl("update",array('id'=>$data->id)),
		array('update'=>'#operationResultDiv'), array('class'=>'input fright button','id'=>uniqid('edit_culinary'),'id'=>uniqid('akbe_')));

?>
    <?php echo CHtml::link(
    'Delete', array('delete','id'=>$data->id),
     array('confirm' => 'Are you sure?','id' =>uniqid('akb_'),'class'=>'input fright button'));
?> </div>
  <div class="fix"></div>
</div>

</div>
<div class="ndata bbot">

<div id="primary">
    
    	<div class="img_avt">
        
       <p style="position: absolute; margin: 60px 0 0 130px; font-size: 9px ">     
	<?php 
	if(!empty($data->photo_uploader)){
	
			echo CHtml::link(
					'Remove Logo', array('deleteImage','id'=>$data->photo_uploader->id),
					array('confirm' => 'Are you sure?'));?> </p>
                        
        <?php                
			echo CHtml::image(Yii::app()->baseUrl.$data->photo_uploader->location.$data->photo_uploader->name,$data->photo_uploader->name,array('class'=>'avatar','width'=>'70','height'=>'70'));
	
                         ?>

            
	
	<?php }	?>
       
</div>
    
    <div><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</div>
	<span><?php echo CHtml::encode($data->first_name); ?></span>
	
	

	<div><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</div>
	<span><?php echo CHtml::encode($data->last_name); ?></span>
	
	<div><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</div>
	<span><?php echo CHtml::encode($data->phone); ?></span>
		 
	<div><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</div>
	<span><?php echo CHtml::encode($data->country); ?></span>
	
	<div><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</div>
	<span><?php echo CHtml::encode($data->city); ?></span>

	<div><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</div>
	<span><?php echo CHtml::encode($data->state); ?></span>
	
	<div><?php echo CHtml::encode($data->getAttributeLabel('street')); ?>:</div>
	<span><?php echo CHtml::encode($data->street); ?></span>
	
   <div><?php echo CHtml::encode($data->getAttributeLabel('zip')); ?>:</div>
	<span><?php echo CHtml::encode($data->zip); ?></span>




</div>
    
 


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



























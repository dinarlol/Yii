
<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery-ui');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/thumbnails_func.js');


?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'culinary-arts-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),

)); 




?>
<fieldset>
<legend><?php echo $type;?> Culinary </legend>

	<p class="note">Field with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		
	<div class="row">
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
		<div class="row">
		<?php echo $form->labelEx($model,'upload'); ?>
		
		<?php $wid = $this->widget('CMultiFileUpload', array(
				'id'=>'upload',
				'htmlOptions' =>array('class'=>'formbtn ml10'),
				'name'=>AkimboNuggetManager::$content_type_photo,
				'accept' => 'jpg',
				'denied' => 'Picture should be in .jpg format',
		)); 
		
		//echo $wid->viewPath.' is a path';
		?>
		<?php echo $form->error($model,'pics_id'); ?>
			</div>
	
	
	<?php  if(!empty($model->id)){echo $form->hiddenField($model,'id');}?>
	<?php  if(!empty($model->create_date)){echo $form->hiddenField($model,'create_date');}?>
	<?php  if(!empty($model->user_id)){echo $form->hiddenField($model,'user_id');}?>
	<?php  if(!empty($model->photo_uploader)){?>
	<div class="pic">
	<ul>
	<?php 
		
		foreach ($model->photo_uploader as $photo){
?><li>
<a tilte="" href=""  id="<?php echo uniqid('akba_');?>">
<?php 			
echo CHtml::image(Yii::app()->baseUrl.$photo->location.$photo->name,$photo->name,array('class'=>'avatar','width'=>'70','height'=>'70'));
?>			
</a>
<div class="actions" style="display: none;">
                            <?php 
                            
                            echo CHtml::link(
                            		CHtml::image(Yii::app()->baseUrl.'/'.AkimboNuggetManager::IMAGE_DELETE), array('deleteImage','id'=>$photo->id),
                            		array('confirm' => 'Are you sure?','id' =>uniqid('akb_')))
                            
                            ?>
                        </div></li>
                        
                        <?php 
		}
	?>
	</ul>
	</div>
	<?php //	echo CHtml::image(Yii::app()->baseUrl.$model->photo_uploader->location,array('class'=>'avatar','width'=>'130','height'=>'140'));
	}
		?>
	
		<div class="row">
		<?php echo $form->labelEx($model,'inspiredby'); ?>
		<?php echo $form->textField($model,'inspiredby',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'inspiredby'); ?>
	</div>
	</div>
	



	
		<div class="buttonrow">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'basicBtn'));  
                 ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

<!-- form -->
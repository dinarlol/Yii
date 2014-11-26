<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery-ui');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/thumbnails_func.js');


?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'travel-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
		'focus'=>array($model,'destination_id'),

)); ?>

<fieldset>
  <legend><?php echo $type;?> Travel </legend>
  <p class="note">Field with <span class="required">*</span> are required.</p>
  <?php echo $form->errorSummary($model); ?>
  
  <div> <?php echo $form->labelEx($model,'pics_id'); ?>
    <input type="hidden" name="hash" value = "travel">
    <?php $this->widget('CMultiFileUpload', array(
				'id'=>'pic_id',
				'htmlOptions' =>array('class'=>'formbtn ml10'),
				'name'=>AkimboNuggetManager::$content_type_photo,
				'accept' => 'jpg',
				'denied' => 'Picture should be in .jpg format',
		)); ?>
    <?php echo $form->error($model,'pics_id'); ?> </div>
  
  
  <div>
    <?php  if(!empty($model->id)){echo $form->hiddenField($model,'id');}?>
    <?php  if(!empty($model->create_date)){echo $form->hiddenField($model,'create_date');}?>
    <?php  if(!empty($model->user_id)){echo $form->hiddenField($model,'user_id');}?>
    <?php  if(!empty($model->photo_uploader)){?>
    
      <div class="photo_section">
      <div class="pic">
      <ul>
        <?php 
		
		foreach ($model->photo_uploader as $photo){
?>
        <li style="float:left"> <a tilte="" href=""  id="<?php echo uniqid('akba_');?>">
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
          </div>
        </li>
        <?php 
		}
	?>
      </ul>
    </div>
      </div>
      
      
      <div class="fix"></div>
      
    <?php //	echo CHtml::image(Yii::app()->baseUrl.$model->photo_uploader->location,array('class'=>'avatar','width'=>'130','height'=>'140'));
	}
		?>
    <?php echo $form->labelEx($model,'destination_id'); ?> <?php echo  $form->DropDownList($model,'destination_id',CHtml::listData(Destinations::model()->findAll(), 'id', 'name'),array('empty'=>'Select Destination'));?> <?php echo $form->error($model,'destination_id'); ?> </div>
  
  
  
  
  <div> <?php echo $form->labelEx($model,'video_id'); ?>
    <?php 
		
		$this->widget('CMultiFileUpload', array(
				'id'=>'videos_id',
				'htmlOptions' =>array('class'=>'formbtn ml10'),
				'name'=>AkimboNuggetManager::$content_type_video,
				'accept' => 'avi',
				'denied' => 'Video should be in .avi format',
		));
		?>
    <?php echo $form->error($model,'video_id'); ?> </div>
  <div class="buttonrow"> <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array("id"=>"test",'class'=>'basicBtn'));  
                
                /*
                
                echo CHtml::ajaxSubmitButton("Save",  $this->createAbsoluteUrl("create"),
                        array(
			'type' =>'POST',
    			'update' => '#ajaxResult',
                      'dataType' => 'html',
                        		'data'=>'js:$("#travel-form").serialize()',
			'success'=>'function(data){
                                    validate(data);	
			}',
		
                         
			),
                        array(
                            "id"=>"btnSubmit",
                        )
				

		); 

                echo CHtml::ajaxButton ('Hire',$this->createAbsoluteUrl("create"),
                		array('type' =>'POST','update' => '#formdata','data'=>'js:$("#travel-form").serialize()'),array('class' => 'input'));
                
               */ ?> </div>
</fieldset>
<?php $this->endWidget(); ?>

<!-- form -->
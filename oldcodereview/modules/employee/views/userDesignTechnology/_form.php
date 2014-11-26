<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery-ui');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/thumbnails_func.js');


?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-design-technology-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

<fieldset>
<legend><?php echo $type;?> Design & Technology  </legend>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div>
		<?php echo $form->labelEx($model,'design_technology_id'); ?>
		<?php echo  $form->DropDownList($model,'design_technology_id',CHtml::listData(DesignTechnology::model()->findAll(), 'id', 'name'),array('empty'=>'Select Design'));?>
		
		<?php echo $form->error($model,'design_technology_id'); ?>
	</div>
	
		<?php  if(!empty($model->document_uploader)){?>
	<div class="pic">
	<ul>
	<?php 
		
		foreach ($model->document_uploader as $photo){
?><li>
<a tilte="" href=""  id="<?php echo uniqid('akba_');?>">
<?php 			
echo CHtml::image(Yii::app()->baseUrl.$photo->location.$photo->name,$photo->name,array('class'=>'avatar','width'=>'70','height'=>'70'));
?>			
</a>
<div class="actions" style="display: none;">
                            <?php 
                            
                            echo CHtml::link(
                            		CHtml::image(Yii::app()->baseUrl.'/'.AkimboNuggetManager::IMAGE_DELETE), array('deleteDoc','id'=>$photo->id),
                            		array('confirm' => 'Are you sure?','id' =>uniqid('akb_')))
                            
                            ?>
                        </div></li>
                        
                        <?php 
		}
	?>
	</ul>
	</div>
	<?php //	echo CHtml::image(Yii::app()->baseUrl.$model->document_uploader->location,array('class'=>'avatar','width'=>'130','height'=>'140'));
	}
		?>

	<div>
		<?php echo $form->labelEx($model,'designer_inspired_by'); ?>
		<?php echo $form->textField($model,'designer_inspired_by',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'designer_inspired_by'); ?>
	</div>

		<div>
		<?php echo $form->labelEx($model,'upload'); ?>
		
		<?php $this->widget('CMultiFileUpload', array(
				'id'=>'upload',
				'name'=>AkimboNuggetManager::$content_type_document,
				'accept' => 'pdf',
				'denied' => 'Document should be in .pdf format',
		)); ?>
		<?php echo $form->error($model,'pics_id'); ?>
			</div>
			
	<div class="buttonrow">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'basicBtn')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

<!-- form -->
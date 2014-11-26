<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery-ui');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/thumbnails_func.js');


?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-business-intrepreneurship-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

<fieldset>
<legend><?php echo $type;?> Business/Intrepreneurships  </legend>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div>
		<?php echo $form->labelEx($model,'relevant_business_projects'); ?>
		<?php echo $form->textField($model,'relevant_business_projects',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'relevant_business_projects'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'ventures'); ?>
		<?php echo $form->textField($model,'ventures',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'ventures'); ?>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'inspiredby'); ?>
		<?php echo $form->textField($model,'inspiredby',array('size'=>60,'maxlength'=>77)); ?>
		<?php echo $form->error($model,'inspiredby'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
	
		<?php  if(!empty($model->document_uploader)){?>
	<div class="pic">
	<ul>
	<?php 
		
		foreach ($model->document_uploader as $doc){
?><li>
<a tilte="" href=""  id="<?php echo uniqid('akba_');?>">
<?php 			
echo CHtml::image(Yii::app()->baseUrl.$doc->location.$doc->name,$doc->name,array('class'=>'avatar','width'=>'70','height'=>'70'));
?>			
</a>
<div class="actions" style="display: none;">
                            <?php 
                            
                            echo CHtml::link(
                            		CHtml::image(Yii::app()->baseUrl.'/'.AkimboNuggetManager::IMAGE_DELETE), array('deleteImage','id'=>$doc->id),
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
		<?php echo $form->labelEx($model,'upload'); ?>
		
		<?php $this->widget('CMultiFileUpload', array(
				'id'=>'upload',
				'name'=>AkimboNuggetManager::$content_type_document,
				'accept' => 'pdf',
				'denied' => 'Document should be in .pdf format',
		)); ?>
		<?php echo $form->error($model,'upload'); ?>
			</div>
			
	<div class="buttonrow">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'basicBtn')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

<!-- form -->
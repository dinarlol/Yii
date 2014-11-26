<?php 
/*
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery-ui');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/thumbnails_func.js');

$cs->registerScriptFile(Yii::app()->baseUrl.'/js/effects.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/prototube.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/prototype.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/scriptaculous.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/swfobject.js');


echo CHtml::cssFile(Yii::app()->baseUrl.'/css/prototube.css')

*/
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-music-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
<fieldset>
<legend><?php echo $type;?> Music </legend>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
<?php 
$detailModel = $model->userMusicDetails;
if(empty($detailModel)){
	$model->userMusicDetails = new UserMusicDetail();
	$detailModel = $model->userMusicDetails;
}

?>
	<?php echo $form->errorSummary($detailModel); ?>

	
	
	<div>
	
	<div>
	<?php if(empty($model->userMusicDetails[0])):?>
	
	
		<?php echo $form->labelEx($model->userMusicDetails,'field_id'); ?>
		<?php echo  $form->DropDownList($model->userMusicDetails,'field_id',CHtml::listData(MusicFields::model()->findAll(), 'id', 'name'),array('empty'=>'Select Field'));?>
		<?php echo $form->error($model->userMusicDetails,'field_id'); ?>
	</div>
	
	
		<?php  if(empty($model->userMusicDetails->video_uploader)){
			$model->userMusicDetails->video_uploader = new VideoUploader();
			
		}?>
	
	<div>
		<?php echo $form->labelEx($model->userMusicDetails->video_uploader,'link'); ?>
		<?php echo $form->textField($model->userMusicDetails->video_uploader,'link',array('size'=>100,'maxlength'=>275)); ?>
		<?php echo $form->error($model->userMusicDetails->video_uploader,'link'); ?>
	</div>
	
	<div>
		<?php echo $form->hiddenField($model->userMusicDetails->video_uploader,'id',array('size'=>100,'maxlength'=>275)); ?>
		<?php echo $form->error($model->userMusicDetails->video_uploader,'id'); ?>
	</div>
	
	<?php else: ?>
	
	<?php foreach ($model->userMusicDetails as $userMusicDetails):?>
	
	<div>
		<?php echo $form->labelEx($userMusicDetails,'field_id'); ?>
		<?php echo  $form->DropDownList($userMusicDetails,'field_id',CHtml::listData(MusicFields::model()->findAll(), 'id', 'name'),array('empty'=>'Select Field'));?>
		<?php echo $form->error($userMusicDetails,'field_id'); ?>
	</div>
	
	
		<?php  if(empty($userMusicDetails->video_uploader)){
			$userMusicDetails->video_uploader = new VideoUploader();
				
		}?>
		
		<?php 
		
		if(is_array($userMusicDetails->video_uploader)):
		
		foreach ($userMusicDetails->video_uploader as $video_uploader):?>
		
	
	<div>
		<?php echo $form->labelEx($video_uploader,'link'); ?>
		<?php echo $form->textField($video_uploader,'link',array('size'=>100,'maxlength'=>275)); ?>
		<?php echo $form->error($video_uploader,'link'); ?>
	</div>
	
	<div>
		<?php echo $form->hiddenField($video_uploader,'id',array('size'=>100,'maxlength'=>275)); ?>
		<?php echo $form->error($video_uploader,'id'); ?>
	</div>
	
	<?php endforeach;?>
	
	<?php else:?>
	
	<div>
		<?php echo $form->labelEx($userMusicDetails->video_uploader,'link'); ?>
		<?php echo $form->textField($userMusicDetails->video_uploader,'link',array('size'=>100,'maxlength'=>275)); ?>
		<?php echo $form->error($userMusicDetails->video_uploader,'link'); ?>
	</div>
	
	<div>
		<?php echo $form->hiddenField($userMusicDetails->video_uploader,'id',array('size'=>100,'maxlength'=>275)); ?>
		<?php echo $form->error($userMusicDetails->video_uploader,'id'); ?>
	</div>
	
	
	
	<?php endif;?>
	
	
	
	<?php endforeach;?>
	
	
	
	<?php endif;?>
	
	
	<div>
		<?php echo $form->labelEx($model,'inspired_by'); ?>
		<?php echo $form->textField($model,'inspired_by',array('size'=>60,'maxlength'=>245)); ?>
		<?php echo $form->error($model,'inspired_by'); ?>
	</div>
	
	
	</div>
	
	
	
	<div class="buttonrow">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'basicBtn')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

<!-- form -->
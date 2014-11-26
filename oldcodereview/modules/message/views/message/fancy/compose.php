<div class="form-container">

<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Compose"),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_styles') ?>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_flash') ?>

<div class="row">
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation'); ?>
	<div class="span13">
		

		<div class="form">
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'message-form',
				'enableAjaxValidation'=>false,
			)); ?>

			<fieldset>
			<legend>Compose Message	</legend>
			
			
			<p class="note"><?php echo MessageModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

			<?php echo $form->errorSummary($model, null, null, array('class' => 'alert-message block-message error')); ?>

			<?php echo $form->labelEx($model,'receiverUserId'); ?>
			<div class="input">
				<?php echo CHtml::textField('receiver', $receiverName) ?>
				<?php echo $form->hiddenField($model,'receiverUserId'); ?>
				<?php echo $form->error($model,'receiverUserId'); ?>
			</div>

			<?php echo $form->labelEx($model,'subject'); ?>
			<div class="input">
				<?php echo $form->textField($model,'subject'); ?>
				<?php echo $form->error($model,'subject'); ?>
			</div>

			<?php echo $form->labelEx($model,'message'); ?>
			<div class="input">
				<?php 
			$this->widget('ext.editMe.ExtEditMe', array(
					'model'=>$model,
					'attribute'=>'message',
					'htmlOptions'=>array('option'=>'value'),
					
					
			));
			
			?>
				<?php echo $form->error($model,'message'); ?>
			</div>
			
			
			
			

			<div class="buttons">
				<button class="btn primary"><?php echo MessageModule::t("Send") ?></button>
			<button class="btn primary" id="drafts" name="drafts"><?php echo MessageModule::t("Draft") ?></button>
			</div>
</fieldset>
			<?php $this->endWidget(); ?>

		</div>
	</div>
</div>
</div>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>

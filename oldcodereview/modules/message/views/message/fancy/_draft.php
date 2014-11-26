<div class="form-container">
<?php $this->pageTitle=Yii::app()->name . ' - ' . MessageModule::t("Compose Message"); ?>
<?php $isIncomeMessage = $viewedMessage->receiverUserId == Yii::app()->user->getId() ?>

<?php
	$this->breadcrumbs = array(
		MessageModule::t("Messages"),
		($isIncomeMessage ? MessageModule::t("Inbox") : MessageModule::t("Sent")) => ($isIncomeMessage ? 'inbox' : 'sent'),
		CHtml::encode($viewedMessage->subject),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_styles') ?>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_flash') ?>

<div>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>
	<div class="span13">
		<?php $form = $this->beginWidget('CActiveForm', array(
			'id'=>'message-delete-form',
			'enableAjaxValidation'=>false,
			'action' => $this->createUrl('delete/', array('id' => $viewedMessage->id))
		)); ?>
		
		
		
		<button class="btn danger"><?php echo MessageModule::t("Delete") ?></button>
		<?php $this->endWidget(); ?>

		


		<div class="form">
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'message-form',
				'enableAjaxValidation'=>false,
					'action' => $this->createAbsoluteUrl('compose', array('id' => $viewedMessage->id))
			)); ?>
			
			<fieldset>
			<legend>Draft	</legend>

			<?php echo $form->errorSummary($viewedMessage, null, null, array('class' => 'alert-message block-message error')); ?>
			
			<div class="input">
				<?php echo $form->hiddenField($viewedMessage,'receiverUserId'); ?>
				<?php echo $form->error($viewedMessage,'receiverUserId'); ?>
			</div>
			<?php echo $form->labelEx($viewedMessage,'receiverUserId'); ?>
			<div class="input">
				<?php echo CHtml::textField('receiver', $receiverName) ?>
				<?php echo $form->error($viewedMessage,'receiverUserId'); ?>
			</div>
			
			<?php echo $form->labelEx($viewedMessage,'subject'); ?>
			<div class="input">

				<?php echo $form->textField($viewedMessage,'subject'); ?>
				<?php echo $form->error($viewedMessage,'subject'); ?>
			</div>

			<?php echo $form->labelEx($viewedMessage,'message'); ?>
			<div class="input">
					<?php 
			$this->widget('ext.editMe.ExtEditMe', array(
					'model'=>$viewedMessage,
					'attribute'=>'message',
					'htmlOptions'=>array('option'=>'value'),
					
					
			));
			
			?>
				<?php echo $form->error($viewedMessage,'message'); ?>
			</div>

			<div class="buttons">
				<button class="btn primary"><?php echo MessageModule::t("Send") ?></button>
			<button class="btn primary" id="draft-edit" name="draft-edit"><?php echo MessageModule::t("Draft") ?></button>
			</div>
</fieldset>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
</div>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_draft_suggest'); ?>
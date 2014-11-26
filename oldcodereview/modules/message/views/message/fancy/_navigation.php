<div class="span2">
	<ul class="messages-nav pills">
		<li><a href="<?php echo $this->createUrl('inbox/') ?>">inbox <?php if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): ?>
			(<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?>)
		<?php endif; ?></a></li>
		<li><a href="<?php echo $this->createAbsoluteUrl('/'.$this->module->id.'/sent/sent') ?>">sent</a></li>
		<li><a href="<?php echo $this->createAbsoluteUrl('/'.$this->module->id.'/compose') ?>">compose</a></li>
		<li><a href="<?php echo $this->createAbsoluteUrl('/'.$this->module->id.'/inbox/draft') ?>">draft</a></li>
	</ul>
</div>

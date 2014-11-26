<?php
/* @var $this UserMailBoxMailsController */
/* @var $model UserMailBoxMails */

$this->breadcrumbs=array(
	'User Mail Box Mails'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserMailBoxMails', 'url'=>array('index')),
	array('label'=>'Create UserMailBoxMails', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-mail-box-mails-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Mail Box Mails</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-mail-box-mails-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'subject',
		'message',
		'create_date',
		'senderUserId',
		'receiverUserId',
		/*
		'isRead',
		'sender_deleted',
		'receiver_deleted',
		'modified_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

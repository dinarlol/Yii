<?php
/* @var $this UserMailBoxDraftsController */
/* @var $model UserMailBoxDrafts */

$this->breadcrumbs=array(
	'User Mail Box Drafts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserMailBoxDrafts', 'url'=>array('index')),
	array('label'=>'Create UserMailBoxDrafts', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-mail-box-drafts-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Mail Box Drafts</h1>

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
	'id'=>'user-mail-box-drafts-grid',
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
		'modified_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

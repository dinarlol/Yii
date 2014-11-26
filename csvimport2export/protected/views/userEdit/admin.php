<?php
/* @var $this UserEditController */
/* @var $model UserEdit */

$this->breadcrumbs=array(
	'User Edits'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserEdit', 'url'=>array('index')),
	array('label'=>'Create UserEdit', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-edit-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Edits</h1>

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
	'id'=>'user-edit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'date_modified',
		'user_id',
		'password',
		'name',
		'attn',
		'street',
		/*
		'city',
		'state',
		'zip',
		'tel',
		'cell',
		'email',
		'tax_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

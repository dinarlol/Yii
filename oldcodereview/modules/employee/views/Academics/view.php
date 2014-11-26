<?php
$this->breadcrumbs=array(
	'User Academics'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserAcademic', 'url'=>array('index')),
	array('label'=>'Create UserAcademic', 'url'=>array('create')),
	array('label'=>'Update UserAcademic', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserAcademic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserAcademic', 'url'=>array('admin')),
);
?>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'school',
		'graduation_date',
		'major_subject_id',
		'minor_subject_id',
		'concentration',
		'gpa',
		'create_date',
		'modified_date',
	),
)); ?>

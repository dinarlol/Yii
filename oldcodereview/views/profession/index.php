<?php
$this->breadcrumbs=array(
	'Professions',
);

$this->menu=array(
	array('label'=>'Create Profession', 'url'=>array('create')),
	array('label'=>'Manage Profession', 'url'=>array('admin')),
);
?>

<h1>Professions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

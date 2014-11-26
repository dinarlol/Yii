<?php
$this->breadcrumbs=array(
	'Music Fields',
);

$this->menu=array(
	array('label'=>'Create MusicFields', 'url'=>array('create')),
	array('label'=>'Manage MusicFields', 'url'=>array('admin')),
);
?>

<h1>Music Fields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

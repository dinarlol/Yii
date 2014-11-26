<?php
$this->breadcrumbs=array(
	'Industries',
);

$this->menu=array(
	array('label'=>'Create Industry', 'url'=>array('create')),
	array('label'=>'Manage Industry', 'url'=>array('admin')),
);
?>

<h1>Industries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

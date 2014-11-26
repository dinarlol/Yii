<?php
$this->breadcrumbs=array(
	'User About Mes',
);

$this->menu=array(
	array('label'=>'Create UserAboutMe', 'url'=>array('create')),
	array('label'=>'Manage UserAboutMe', 'url'=>array('admin')),
);
?>

<h1>User About Mes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

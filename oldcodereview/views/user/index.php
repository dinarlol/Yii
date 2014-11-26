<?php

$this->breadcrumbs=array(
	'Home',
);
?>

<h1>Persons</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Company',
);


?>

<h1>Companys</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

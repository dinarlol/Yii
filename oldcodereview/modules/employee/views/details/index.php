<?php
$this->breadcrumbs=array(
	'Personal Info',
);


?>

<h1>User Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Profile',
);
?>
<h1>User Details</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>$key.'/_view',
)); ?>

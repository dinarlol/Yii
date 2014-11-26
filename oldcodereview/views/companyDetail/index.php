<?php
$this->breadcrumbs=array(
	'Company Details',
);

$this->menu=array(
	array('label'=>'Create CompanyDetail', 'url'=>array('create')),
	array('label'=>'Manage CompanyDetail', 'url'=>array('admin')),
);
?>

<h1>Company Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

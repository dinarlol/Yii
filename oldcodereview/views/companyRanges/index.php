<?php
$this->breadcrumbs=array(
	'Company Ranges',
);

$this->menu=array(
	array('label'=>'Create CompanyRanges', 'url'=>array('create')),
	array('label'=>'Manage CompanyRanges', 'url'=>array('admin')),
);
?>

<h1>Company Ranges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

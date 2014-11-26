<?php
$this->breadcrumbs=array(
	'Company Looking To Hires',
);

$this->menu=array(
	array('label'=>'Create CompanyLookingToHire', 'url'=>array('create')),
	array('label'=>'Manage CompanyLookingToHire', 'url'=>array('admin')),
);
?>

<h1>Company Looking To Hires</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

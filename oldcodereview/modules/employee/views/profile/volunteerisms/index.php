<?php
$this->breadcrumbs=array(
	'User Volunteerisms',
);

$this->menu=array(
	array('label'=>'Create UserVolunteerism', 'url'=>array('create')),
	array('label'=>'Manage UserVolunteerism', 'url'=>array('admin')),
);
?>
<div class="nugget_edit">
    <div class="operationResultDiv" id="operationResultDiv"></div>
    
    
    
<div class="nugget_heading"><span class="community"></span><h2>Volunteerism</h2>



</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>$key.'/_view',
)); ?>
</div>




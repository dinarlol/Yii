<?php
$this->breadcrumbs=array(
	'User Details',
);
$this->menu=array(
	array('label'=>'Create UserDetails', 'url'=>array('create')),
	array('label'=>'Manage UserDetails', 'url'=>array('admin')),
);
?>
<div class="nugget_edit">
<div class="operationResultDiv" id="operationResultDiv"> </div>    
    
<div class="nugget_heading"><span class="academic"></span><h2>User Details</h2>
<div class="addbtn">    
<div class="operationDiv"><?php 
   //echo CHtml::ajaxLink('Add', $this->createAbsoluteUrl("create"),array('update'=>'#operationResultDiv'), array('class'=>'input','id'=>'add_nugget_academic'));
if($dataProvider->getTotalItemCount() == 0){
echo CHtml::ajaxLink('Add', $this->createAbsoluteUrl("create"),
		array('update'=>'#operationResultDiv'), array('class'=>'input','id'=>'add_nugget_academic'));
}
?>
</div>
</div>    
    </div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>$key.'/_view',
)); ?>



</div>
<?php
$dataProvider = $model->search();
?>
<div class="nugget_edit">
<div class="operationResultDiv" id="operationResultDiv"> </div>    
    
<div class="nugget_heading"><span class="details"></span><h2>User Details</h2>
<div class="addbtn">    
<div class="operationDiv"><?php 
   //echo CHtml::ajaxLink('Add', $this->createAbsoluteUrl("create"),array('update'=>'#operationResultDiv'), array('class'=>'input','id'=>'add_nugget_academic'));
if($dataProvider->getTotalItemCount() == 0){
echo CHtml::ajaxLink('Add', $this->createAbsoluteUrl("create"),
		array('update'=>'#operationResultDiv'), array('class'=>'input','id'=>'add_nugget_user_details'));
}
?>
</div>
</div>    
    </div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>



</div>



        
     

<div class="nugget_edit">
    <div class="operationResultDiv" id="operationResultDiv">
        </div>
    <div class="nugget_heading"><span class="military"></span><h2>Military Service</h2></div>

    <div class="addbtn">
    <div class="operationDiv"><?php 
echo CHtml::ajaxLink('Add', $this->createAbsoluteUrl("create"),
		array('update'=>'#operationResultDiv'), array('class'=>'input button','id'=>'add_military_button'));

?>
</div>    </div>
    
    
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>



</div>
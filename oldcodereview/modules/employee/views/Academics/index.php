<div class="nugget_edit">
<div class="operationResultDiv" id="operationResultDiv"></div>     
<div class="nugget_heading"><span class="academic"></span><h2>Academic</h2>
<div class="addbtn">
<div id="ajaxResult">
<div class="operationDiv"><?php 
echo CHtml::ajaxLink('Add', $this->createAbsoluteUrl("create"),
		array('update'=>'#operationResultDiv'), array('class'=>'input button','id'=>'add_nugget_academic'));

?></a></div>

        
</div>
    </div>
    

</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>






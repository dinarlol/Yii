<div class="nugget_edit mt10">
    <div class="operationResultDiv" id="operationResultDiv">
        </div>
    <div class="nugget_heading"><span class="about"></span><h2>About Me</h2></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>$key.'/_view',
)); ?>



</div>
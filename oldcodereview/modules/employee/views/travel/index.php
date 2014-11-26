       
        
<div class="nugget_edit">
<div class="form-container" id="operationResultDiv"> </div>   
<div class="nugget_heading"><span class="travel"></span><h2>Travel</h2><div class="addbtn"><div id ="ajaxResult">
<div class="operationDiv"><?php 
echo CHtml::ajaxLink('Add', $this->createAbsoluteUrl("create"),
		array('update'=>'#operationResultDiv'), array('class'=>'input button','id'=>'add_nugget_travel'));

?>
</div>

        
        </div></div></div>
</div>
        


<?php 

$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery-ui');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/thumbnails_func.js');
?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_view',
		'htmlOptions' =>array('class'=>'nugget_edit'),
		
)); ?>

        
      
        
     

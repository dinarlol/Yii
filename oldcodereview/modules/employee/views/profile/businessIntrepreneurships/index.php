
        
<div class="nugget_edit">
<div class="nugget_heading"><span class="business"></span><h2>Business/Intrepreneurships</h2>

  

</div>

        


<?php 

$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery-ui');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/thumbnails_func.js');
?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>$key.'/_view',
		'htmlOptions' =>array('class'=>'nugget_edit'),
		
)); ?>

  </div>
     
     
        
<?php 

$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery-ui');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/thumbnails_func.js');

$cs->registerScriptFile(Yii::app()->baseUrl.'/js/effects.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/prototube.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/prototype.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/scriptaculous.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/swfobject.js');


?>
<div class="nugget_edit">
<div class="nugget_heading"><span class="music"></span><h2>Music</h2>
</div>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>$key.'/_view',
		'htmlOptions' =>array('class'=>'nugget_edit'),
		
)); ?>









        
     

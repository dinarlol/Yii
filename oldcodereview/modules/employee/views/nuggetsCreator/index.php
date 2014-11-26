<?php

echo CHtml::dropDownList('nugget_id','', $nuggetsList,
		array(
				'ajax' => array(
						'type'=>'POST', //request type
						'url'=>'js:"index.php?r=employee/NuggetsCreator/"+$(this).val()', //url to call.
						//Style: CController::createUrl('currentController/methodToCall')
						'update'=>'#mainform', //selector to update
						'data'=>array('nugget'=>'js:$(this).val()'),
//leave out the data key to pass all form values through
				)));

//empty since it will be filled by the other dropdown
//echo CHtml::dropDownList('city_id','', array());
?>

<div class="content">
<div id="mainform" class="widget"></div>

</div>
<?php


if($assign == 'add'){
	echo CHtml::ajaxButton('Remove from Potential Employer', $this->createAbsoluteUrl('potentialEmployerRemove'),
						array('update'=>'#potentialEmployerDiv','data'=>'js:$("#potential_employer-form").serialize()'), array('class'=>'greenBtn','id'=>'potentialEmployebtnRemove'));
	}
	
else if($assign == 'remove'){
	echo CHtml::ajaxButton('Add to Potential Employer', $this->createAbsoluteUrl('potentialEmployerAdd'),
			array('update'=>'#potentialEmployerDiv','data'=>'js:$("#potential_employer-form").serialize()'), array('class'=>'greenBtn','id'=>'potentialEmployebtnAdd'));
	}	


?>
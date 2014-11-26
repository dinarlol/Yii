<?php
$this->breadcrumbs=array(
	'User Work Experiences'=>array('index'),
	'Create',
);
$this->menu=array(
	array('label'=>'List UserWorkExperience', 'url'=>array('index')),
	//array('label'=>'Manage UserWorkExperience', 'url'=>array('admin')),
);
?>
<?php //echo $user_id; die;?>
<?php echo $this->renderPartial('_form', array('model'=>$model,'user_id'=>$user_id,'sector_data'=>$sector_data)); ?>
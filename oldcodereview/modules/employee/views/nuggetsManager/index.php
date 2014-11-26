<?php
$this->breadcrumbs=array(
	'Nuggets Manager',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
<form method="post">
<select name="url" onchange="switchpage(this)">
<option value="" selected="selected">Choose Nuggets</option>
<option value="<?php echo Yii::app()->createUrl('employee/userWorkExperience/index')?>">Add Work Experience</option>
<option value="<?php echo Yii::app()->createUrl('employee/userAcademic/index')?>">Add Academic</option>
<option value="<?php echo Yii::app()->createUrl('employee/userMilitaryService/index')?>">Add Military Service</option>
<option value="<?php echo Yii::app()->createUrl('employee/userAboutMe/index')?>">Add About Me</option>
</select>
</form>
</p>


<div class="search_content search_profile">

	
	<div id="thumbnail_img"><img width="70" height="70" src="images/avatar.png"> </div>
	<div class="left"><h1>
	<?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:
	<?php echo CHtml::encode($data->first_name); ?>
	</h1></div>
	
	<div class="right mr5">
	<span>
	
	<?php echo CHtml::encode(empty($data->country)?'':$data->country); ?>
	<?php echo CHtml::encode(empty($data->state)?'':", ".$data->state); ?>
	<?php echo CHtml::encode(empty($data->city)?'':", ".$data->city); ?>
	</span></div>

	<div class="profession">
	<h2>
	
	<?php echo CHtml::encode(empty($data->person->userWorkExperiences[0]->title)?'':$data->person->userWorkExperiences[count($data->person->userWorkExperiences) -1]->title); ?>
	<?php echo CHtml::encode(empty($data->person->userWorkExperiences[0]->organization)?'':" At ".$data->person->userWorkExperiences[count($data->person->userWorkExperiences) -1]->organization); ?>
	</h2></div>

	<div class="profession">
	<h2>
	<?php echo CHtml::encode(empty($data->person->userAcademics[0]->school)?'':$data->person->userAcademics[count($data->person->userAcademics) -1]->concentration); ?>
	<?php echo CHtml::encode(empty($data->person->userAcademics[0]->school)?'':" From ".$data->person->userAcademics[count($data->person->userAcademics) -1]->school); ?>
	</h2></div>

	

	<?php /*
	<?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('street')); ?>:
	<?php echo CHtml::encode($data->street); ?>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('zip')); ?>:
	<?php echo CHtml::encode($data->zip); ?>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	*/ ?>
	<div class="short_nav">
         <ul>
<li><a href="#home">Message</a></li>
<li><a href="#contact">Contact</a></li>
<li><a href="#about">Print</a></li>
</ul>


      </div>
<div class="seprator"></div>
</div>
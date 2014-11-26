

<div class="search_widget">

<?php 

$time_utility = new Time();

$this->widget('AkimboSearchView', array(
	'id'=>'person-grid',
	'dataProvider'=>$matrics->search(),
	'filter'=>$matrics,
		'cssFile'=>'css/pager.css',
	'pager'=>array('htmlOptions' =>array('class'=>'pages'),),	
	'columns'=>array(
			/*array(
					'name'=>'companys.name',
					'value'=>'empty($data->companys)?"":$data->companys->name',
			
			),
			
			
			*/

			// start user avatar
			
/*			
			array(
					'type' => 'raw',
					'name'=>'user.userDetails.avatar',
					'value'=>'empty($data->visitor->userDetails->avatar)?$data->visitor->role->name==$data->userRole?"<a id=\"user_avatar".$data->visitor->id."\" href=\"index.php?r=employee/profile&id=".$data->visitor->id."\"><img width=\"55\" height=\"54\" class=\"avatar\" src=\"images/avatar.png\"></a>":"":"<a href=\"index.php?r=employee/profile&id=".$data->visitor->id."\"><img width=\"55\" height=\"54\" class=\"avatar\" src=\"images/".$data->visitor->userDetails->avatar."\"></a>"',
			
			),
			
	
			*/

// finished user avatar

			
			// html define for full name
			array(
					'type' => 'raw',
					'name'=>'visitor.userDetails.first_name',
					'value'=>'empty($data->visitor->userDetails->first_name)?"":"<span class=\"name\"><h3>".$data->visitor->userDetails->first_name." "',
			
			
			
			),
			array(
					'type' => 'raw',
					'name'=>'visitor.userDetails.last_name',
					'value'=>'empty($data->visitor->userDetails->last_name)?"":$data->visitor->userDetails->last_name."</h3></span>"',
			
			),
			// end first name
			
			
			
			//company start 

			array(
					'type' => 'raw',
					'name'=>'visitor.companys.name',
					'value'=>'empty($data->visitor->companys->name)?"":"<span class=\"name\"><h3>".$data->visitor->companys->name."</h3></span>"',
			
			
			
			),
			
			
			// end company
			
			
			
			// start location details for visitor
			
			
			array(
					'type' => 'raw',
					'name'=>'visitor->userDetails.country',
					'value'=>'empty($data->visitor->userDetails->country)?"":"<span class=\"location\">".$data->visitor->userDetails->country." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'visitor->userDetails.state',
					'value'=>'empty($data->visitor->userDetails->state)?"":", ".$data->visitor->userDetails->state." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'visitor->userDetails.city',
					'value'=>'empty($data->visitor->userDetails->city)?"":", ".$data->visitor->userDetails->city."</span> "',
			
			),


			// finished location details

			
			
			// start company location
			
			
			array(
					'type' => 'raw',
					'name'=>'visitor.companys.companyDetails.country',
					'value'=>'empty($data->visitor->companys->companyDetails->country)?" ":"<span class=\"location\">".$data->visitor->companys->companyDetails->country." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'visitor.companys.companyDetails.state',
					'value'=>'empty($data->visitor->companys->companyDetails->state)?"":", ".$data->visitor->companys->companyDetails->state." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'visitor.companys.companyDetails.city',
					'value'=>'empty($data->visitor->companys->companyDetails->city)?"":", ".$data->visitor->companys->companyDetails->city."</span> "',
			
			),
			
			
			
			//finished company location
			
			
			//start professions
			
			array(
					'type' => 'raw',
					'name'=>'visitor.userWorkExperiences.title',
					'value'=>'empty($data->visitor->userWorkExperiences[0]->title)?"":"<span class=\"profession\">".$data->visitor->userWorkExperiences[0]->title."</span>"',
			
			),
			// finished profession
			
			
			
			
			//start Industry
			
			array(
					'type' => 'raw',
					'name'=>'visitor.companys.industry.name',
					'value'=>'empty($data->visitor->companys->industry->name)?"":"<span class=\"profession\">".$data->visitor->companys->industry->name."</span>"',
			
			),
			// finished industry
			
			
			// start education
			array(	'type' => 'raw',
					'name'=>'userAcademics.school',
					'value'=>'empty($data->visitor->userAcademics[0]->school)?"":"<span class=\"education\">".$data->visitor->userAcademics[0]->school."</span>"',
			
			),
			
			// finished education
			
			
			// start company size
			array(	'type' => 'raw',
					'name'=>'visitor.companys.range.range',
					'value'=>'empty($data->visitor->companys->range->range)?"":"<span class=\"education\"> employees: ".$data->visitor->companys->range->range."</span>"',
			
			),
			
		
			

			


		
	),
))
?>





</div>
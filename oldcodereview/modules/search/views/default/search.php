<div class="search_widget">
<?php
Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('#search-filter-form').submit(function(){
		$.fn.yiiGridView.update('search-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>




<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<!-- search-form -->

<?php $this->widget('AkimboSearchView', array(
		'summaryText' => '',
	'id'=>'search-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
		'cssFile'=>'css/pager.css',
	'pager'=>array('htmlOptions' =>array('class'=>'pages'),),	
	'columns'=>array(
		
			/*array(
					'name'=>'companys.name',
					'value'=>'empty($data->companys)?"":$data->companys->name',
			
			),
			*/
			
			

			// start user avatar
			array(
					'type' => 'raw',
					'name'=>'userDetails.avatar',
					'value'=>'empty($data->userDetails->avatar)?$data->role->name==$data->userRole?"<a id=\"user_avatar".$data->id."\" href=\"index.php?r=employee/profile&id=".$data->id."\"><img width=\"55\" height=\"54\" class=\"avatar\" src=\"images/avatar.png\"></a>":"":"<a href=\"index.php?r=employee/profile&id=".$data->id."\"><img width=\"55\" height=\"54\" class=\"avatar\" src=\"images/".$data->userDetails->avatar."\"></a>"',
			
			),
			
			// finished user avatar

			
			
			
			// start company LOGO
			array(
					'type' => 'raw',
					'name'=>'companys.companyDetails.logo',
					'value'=>'empty($data->companys->companyDetails->logo)?$data->role->name==$data->companyRole?"<a id=\"company_logo".$data->id."\" href=\"index.php?r=company/default/profile&id=".$data->id."\"><img width=\"55\" height=\"54\" class=\"avatar\" src=\"images/company_logo.png\"></a>":"":"<a href=\"index.php?r=company/default/profile&id=".$data->id."\"><img width=\"55\" height=\"54\" class=\"avatar\" src=\"images/".$data->companys->companyDetails->logo."\"></a>"',
					
			),
			
			// finished company LOGO
			
			
				// html define for full name
			array(
					'type' => 'raw',
					'name'=>'first_name',
					'value'=>'empty($data->userDetails->first_name)?"":"<span class=\"name\"><h3>".$data->userDetails->first_name." "',
					
					
			),
			array(
					'type' => 'raw',
					'name'=>'last_name',
					'value'=>'empty($data->userDetails->last_name)?"":$data->userDetails->last_name."</h3></span>"',
			
			),
			// end first name

			
			
			// start company name

			array(
					'type' => 'raw',
					'name'=>'companys.name',
					'value'=>'empty($data->companys->name)?"":"<span class=\"name\"><h3>".$data->companys->name."</h3></span>"',
			
			
			
			),
			
			
			// end company name
			

			// start user location
						
			
			array(
					'type' => 'raw',
					'name'=>'userDetails.country',
					'value'=>'empty($data->userDetails->country)?"":"<span class=\"location\">".$data->userDetails->country." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'userDetails.state',
					'value'=>'empty($data->userDetails->state)?"":", ".$data->userDetails->state." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'userDetails.city',
					'value'=>'empty($data->userDetails->city)?"":", ".$data->userDetails->city."</span> "',
			
			),
			
					
			
			//finished user location\

			
			
			// start company location
			
			
			array(
					'type' => 'raw',
					'name'=>'companys.companyDetails.country',
					'value'=>'empty($data->companys->companyDetails->country)?" ":"<span class=\"location\">".$data->companys->companyDetails->country." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'companys.companyDetails.state',
					'value'=>'empty($data->companys->companyDetails->state)?"":", ".$data->companys->companyDetails->state." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'companys.companyDetails.city',
					'value'=>'empty($data->companys->companyDetails->city)?"":", ".$data->companys->companyDetails->city."</span> "',
			
			),
			
			
			
			//finished company location
			
			

			
			
			
				//start professions
	
				array(
						'type' => 'raw',
						'name'=>'userWorkExperiences.title',
						'value'=>'empty($data->userWorkExperiences[0]->title)?"":"<span class=\"profession\">".$data->userWorkExperiences[0]->title."</span>"',
				
				),
				// finished profession

			
			
			
			//start Industry
			
			array(
					'type' => 'raw',
					'name'=>'companys.industry.name',
					'value'=>'empty($data->companys->industry->name)?"":"<span class=\"profession\">".$data->companys->industry->name."</span>"',
			
			),
			// finished industry
			
			
			// start education 
			array(	'type' => 'raw',
					'name'=>'userAcademics.school',
					'value'=>'empty($data->userAcademics[0]->school)?"":"<span class=\"education\">".$data->userAcademics[0]->school."</span>"',
			
			),
			
			// finished education

			
			// start company size
			array(	'type' => 'raw',
					'name'=>'companys.range.range',
					'value'=>'empty($data->companys->range->range)?"":"<span class=\"education\"> employees: ".$data->companys->range->range."</span>"',
			
			),
			
			// finished company size
			
			
			// last to add note or message

			
			
			array(
					'type' => 'raw',
					'name'=>'mini_btn',
					'value'=>'empty($data->companys->id)?"<span class=\"mini_btn\">
    <ul>
    <li><a id=\"user_contact".$data->id."\" href=\"index.php?r=employee/profile&id=".$data->id."\">contact</a></li>
    <li><a id=\"user_profile".$data->id."\" href=\"index.php?r=employee/profile&id=".$data->id."\">Profile</a></li>
    </ul></span>":"<span class=\"mini_btn\">
    <ul>
    <li><a id=\"user_contact".$data->id."\" href=\"index.php?r=company/default/profile&id=".$data->id."\">contact</a></li>
    <li><a id=\"user_profile".$data->id."\" href=\"index.php?r=company/default/profile&id=".$data->id."\">Profile</a></li>
    </ul></span>"',
			
			),
			/*
			array(
					'name'=>'userFitness.details.schoolTeams.name',
					'value'=>'empty($data->userFitness->details[0]->schoolTeams)?"":$data->userFitness->details[0]->schoolTeams->name',
			
			),array(
					'name'=>'userFitness.details.schoolTeams.description',
					'value'=>'empty($data->userFitness->details[0]->schoolTeams)?"":$data->userFitness->details[0]->schoolTeams->description',
			
			),array(
					'name'=>'userFitness.details.collegeTeams.name',
					'value'=>'empty($data->userFitness->details[0]->collegeTeams)?"":$data->userFitness->details[0]->collegeTeams->name',
			
			),array(
					'name'=>'userFitness.details.collegeTeams.description',
					'value'=>'empty($data->userFitness->details[0]->collegeTeams)?"":$data->userFitness->details[0]->collegeTeams->description',
			
			),array(
					'name'=>'userFitness.details.otherTeams.name',
					'value'=>'empty($data->userFitness->details[0]->otherTeams)?"":$data->userFitness->details[0]->otherTeams->name',
			
			),array(
					'name'=>'userFitness.details.otherTeams.description',
					'value'=>'empty($data->userFitness->details[0]->otherTeams)?"":$data->userFitness->details[0]->otherTeams->description',
			
			),
			
			array(
					'name'=>'userWorkExperiences.organization',
					'value'=>'empty($data->userWorkExperiences)?"":$data->userWorkExperiences[0]->organization',
			
			),
			
			
		
			array(
					'name'=>'userAboutMe.objective',
					'value'=>'empty($data->userAboutMe)?"":$data->userAboutMe->objective',
			
			),
			
			
			array(
					'name'=>'userDesignTechnology.designTechnology.name',
					'value'=>'empty($data->userDesignTechnology[0]->designTechnology)?"":$data->userDesignTechnology[0]->designTechnology->name',
			
			),
			array(
					'name'=>'userAwards.award',
					'value'=>'empty($data->userAwards)?"":$data->userAwards[0]->award',
			
			),
			
			array(
					'name'=>'culinaryArts.name',
					'value'=>'empty($data->culinaryArts)?"":$data->culinaryArts[0]->name',
			
			),array(
					'name'=>'culinaryArts.inspiredby',
					'value'=>'empty($data->culinaryArts)?"":$data->culinaryArts[0]->inspiredby',
			
			),array(
					'name'=>'userWritingLiterature.userReadBooks.book',
					'value'=>'empty($data->userWritingLiterature[0]->userReadBooks[0]->book)?"":$data->userWritingLiterature[0]->userReadBooks[0]->book->name',
			
			),array(
					'name'=>'travel.destinations.name',
					'value'=>'empty($data->travel[0]->destinations[0]->name)?"":$data->travel[0]->destinations[0]->name',
			
			),array(
					'name'=>'userPerformingArts.performArt.name',
					'value'=>'empty($data->userPerformingArts[0]->performArt->name)?"":$data->userPerformingArts[0]->performArt->name',
			
			),array(
					'name'=>'userPerformingArts.performInspiredby.name',
					'value'=>'empty($data->userPerformingArts[0]->performInspiredby->name)?"":$data->userPerformingArts[0]->performInspiredby->name',
			
			),array(
					'name'=>'userVisualArts.visualArt.name',
					'value'=>'empty($data->userVisualArts[0]->visualArt->name)?"":$data->userVisualArts[0]->visualArt->name',
			
			),array(
					'name'=>'userVisualArts.visualInspiredby.name',
					'value'=>'empty($data->userVisualArts[0]->visualInspiredby->name)?"":$data->userVisualArts[0]->visualInspiredby->name',
			
			),
			
			array(
					'name'=>'userMilitaryServices.branch.name',
					'value'=>'empty($data->userMilitaryServices[0]->branch->name)?"":$data->userMilitaryServices[0]->branch->name',
			
			),array(
					'name'=>'userMilitaryServices.branch.description',
					'value'=>'empty($data->userMilitaryServices[0]->branch->description)?"":$data->userMilitaryServices[0]->branch->description',
			
			),array(
					'name'=>'userVolunteerisms.cause',
					'value'=>'empty($data->userVolunteerisms->cause)?"":$data->userVolunteerisms->cause',
			
			),array(
					'name'=>'userVolunteerisms.userVolunteerismDetails.link',
					'value'=>'empty($data->userVolunteerisms->userVolunteerismDetails[0]->link)?"":$data->userVolunteerisms->userVolunteerismDetails[0]->link',
			
			),array(
					'name'=>'userVolunteerisms.userVolunteerismDetails.nonprofitOrganizationCauses.nonprofitOrganization.name',
					'value'=>'empty($data->userVolunteerisms->userVolunteerismDetails[0]->nonprofitOrganizationCauses->nonprofitOrganization->name)?"":$data->userVolunteerisms->userVolunteerismDetails[0]->nonprofitOrganizationCauses->nonprofitOrganization->name',
			
			),array(
					'name'=>'userVolunteerisms.userVolunteerismDetails.nonprofitOrganizationCauses.nonprofitCauses.name',
					'value'=>'empty($data->userVolunteerisms->userVolunteerismDetails[0]->nonprofitOrganizationCauses->nonprofitCauses->name)?"":$data->userVolunteerisms->userVolunteerismDetails[0]->nonprofitOrganizationCauses->nonprofitCauses->name',
			
			),array(
					'name'=>'businessIntrepreneurships.ventures',
					'value'=>'empty($data->businessIntrepreneurships[0]->name)?"":$data->businessIntrepreneurships[0]->name',
			
			),array(
					'name'=>'businessIntrepreneurships.relevant_business_projects',
					'value'=>'empty($data->businessIntrepreneurships[0]->relevant_business_projects)?"":$data->businessIntrepreneurships[0]->relevant_business_projects',
			
			),array(
					'name'=>'userStories.story',
					'value'=>'empty($data->userStories[0]->story)?"":$data->userStories[0]->story',
			
			),array(
					'name'=>'userStories.quote',
					'value'=>'empty($data->userStories[0]->quote)?"":$data->userStories[0]->quote',
			
			),array(
					'name'=>'userStories.inspiration',
					'value'=>'empty($data->userStories[0]->inspiration)?"":$data->userStories[0]->inspiration',
			
			),array(
					'name'=>'userStories.impact',
					'value'=>'empty($data->userStories[0]->impact)?"":$data->userStories[0]->impact',
			
			),array(
					'name'=>'userMusics.inspired_by',
					'value'=>'empty($data->userMusics[0]->inspired_by)?"":$data->userMusics[0]->inspired_by',
			
			),array(
					'name'=>'userMusics.field.name',
					'value'=>'empty($data->userMusics[0]->field->name)?"":$data->userMusics[0]->field->name',
			
			),array(
					'name'=>'userMusics.artist.name',
					'value'=>'empty($data->userMusics[0]->artist->name)?"":$data->userMusics[0]->artist->name',
			
			),
			
			*/
			
			
		/*
		'lng',
		'lat',
		'create_date',
		'modified_date',
		*/
		
	),
)); ?>
</div>

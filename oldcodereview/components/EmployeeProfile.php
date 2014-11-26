<?php
class EmployeeProfile{


	private $progress = 0;
	private $selected_profile_category_details = array();
	private $profile_details = array();
	private $profile_detail_menu = array();
	private $person;
	private $title;
	private $selected;
	private $nuggets = array();

        
               
        public static function getAllNuggets()
        {
            $nuggetsArr = array(); 
            $nuggetsArr[] = array(
                "title"=>"Work Experience",
                "link"=> 'userWorkExperience/index',
                "nuggetName"=>'userWorkExperience',
                "span"=>"work"
            );
        
            $nuggetsArr[] = array(
                "title" => "Academic",
                "link"=>"userAcademic/index",
                "nuggetName"=>"userAcademic",
                "span"=>"academic"
            ); 
            return $nuggetsArr; 
        }
        


	public function __construct($person,$selected=null){
		$this->person = $person;
		$this->createProfile($selected);

	}
	
	public static function getProfileViewCountByVisitorId($owner_id,$visitor_id){
		return UsersSiteMatrics::model()->count(array('condition'=>'t.owner_user_id='.$owner_id.' AND t.visitor_user_id='.$visitor_id));
	}

	private function createProfile($selected=null){
		
		
		if(!empty($this->person->userAboutMe)){
			$this->progress+= 5;
			//$organization = ' at  <span class="red">'.$detail->description.'</span>';
			$this->selected_profile_category_details['about'][]= array('title'=>'Objectives: ','date'=>'','organization'=>$this->person->userAboutMe->objective,'section'=>$this->person->userAboutMe->create_date,'description'=>'');
			$hobbies = UserHobbies::model()->findAll("user_id = :user_id", array(":user_id"=>$this->person->id)); 
			$lookingfor = UserLookingFor::model()->findAll("user_id = :user_id", array(":user_id"=>$this->person->id));
			
			// html started 
			$html = '<div class="ndata bbot">
    <div class="description_full">'. $this->person->userAboutMe->objective.'</div>';
			
			if(count($hobbies)>0){
				$html .='<div class="interest">
          <h5>Interest</h5>
          	<ul>';
          	
          	foreach($hobbies as $hobbyRow){
                    $html .="<li>".$hobbyRow->name."</li>";
                }
                
                $html .= '</ul>
        </div>';
			}
			
			if(count($lookingfor)>0){
				
				$html.=' <div class="industry">
          <h5>Industry</h5>
          	<ul>';
			}
			
			
			foreach($lookingfor as $lookingforRow){
				$html.="<li>".CHtml::encode(Industry::model()->findByPk($lookingforRow->industry_id)->name).'</li>';
			}
           $html.='</ul>
        </div>';
			
			$html .='</div>';
			
			
			// html ended
$this->profile_details['about'][] = $html; 
		
		}

		if(!empty($this->person->userAcademics)){
			
			$this->nuggets['Academics']='Academics';
				foreach ($this->person->userAcademics as $detail){
					//print_r($detail);exit;
				$description = '<div class="description">'. $detail->majorSubject->description.', '.$detail->minorSubject->description.'</div>';
				$title = '<span>'.$detail->userEducationTitle->description.' in '.$detail->majorSubject->description.'</span>';
				$organization = '<span class="blue">'.$detail->school.'</span>';
				$this->selected_profile_category_details['academic'][]= array('title'=>$title,'date'=>Time::dateOnly($detail->graduation_date),'organization'=>'from '.$organization,'section'=>$detail->userEducationTitle->description,'description'=>$description);
			}
			$this->progress+= 5;
		
		}
		
		
		if(!empty($this->person->userWorkExperiences) ){
			
			$this->nuggets['workexperience'] ='Work Experience';
			foreach ($this->person->userWorkExperiences as $detail){
				$description = '<div class="description">'. $detail->job_duty.'</div>';
				$title = '<span>'.$detail->title.'</span>';
				$organization = ' at  <span class="red">'.$detail->organization.'</span>';
				$this->selected_profile_category_details['work'][]= array('title'=>$title,'date'=>Time::dateOnly($detail->end_date),'organization'=>$organization,'section'=>$detail->title,'description'=>'');
			}
			$this->progress+= 5;
		}
		

		if(!empty($this->person->userAwards)){
			$this->progress+= 5;
			$this->nuggets['userAwards']='Awards/Recognitions';
			foreach ($this->person->userAwards as $detail){
				$organization = '   <span>'.$detail->description.'</span>';
					$this->selected_profile_category_details['awards'][]= array('title'=>$detail->award,'date'=>Time::dateOnly($detail->date),'organization'=>$organization,'section'=>'awards','description'=>'');
				}

			
		}
		
		if(!empty($this->person->businessIntrepreneurships)){
			$this->progress+= 5;
			$this->nuggets['businessIntrepreneurships'] ='Business/Intrepreneurships';
			//$this->profile_detail_menu['businessIntrepreneurships'] =  array('title'=>'Business/Intrepreneurships','link'=>'profile/businessIntrepreneurships','span'=>'business');
				foreach ($this->person->businessIntrepreneurships as $detail){
					$title = '<span>Business/Intrepreneurships </span>';
					$organization = ' at  <span>'.$detail->ventures.'</span>';
					$this->selected_profile_category_details['business'][]= array('title'=>$title,'date'=>$detail->relevant_business_projects,'organization'=>$organization,'description'=>$detail->inspiredby,'section'=>$detail->link);
				}

			
		}
		if(!empty($this->person->userMusics) ){
			$this->progress+= 5;
			$this->nuggets['userMusics'] ='Music';
				foreach ($this->person->userMusics as $details){
					if(!empty($details->userMusicDetails)){
						foreach ($details->userMusicDetails as $detail){
					$this->selected_profile_category_details['music'][]= array('title'=>'Music ','organization'=> $detail->field->name, 'date'=>$detail->field->name,'description'=>$details->inspired_by,'section'=>$details->inspired_by);
					}
					}

			}
		}
		if(!empty($this->person->userMilitaryServices)){
			$this->progress+= 5;
			$this->nuggets['userMilitaryServices'] ='Military Service';
				foreach ($this->person->userMilitaryServices as $detail){
					$title = $detail->rank.' at ';
					$organization = $detail->devision.' devision';
					$this->selected_profile_category_details['military'][]= array('title'=>$title,'organization'=>$organization,'date'=>$detail->branch->name,'description'=>$detail->branch->description,'section'=>$detail->branch->name);
				}

			
		}
		if(!empty($this->person->userVisualArts) ){
			$this->progress+= 5;
			$this->nuggets['userVisualArts'] ='Visual Arts';
				foreach ($this->person->userVisualArts as $detail){
					$this->selected_profile_category_details['visual'][]= array('title'=>$detail->visualArt->name,'organization'=>'','date'=>Time::dateOnly($detail->datetime),'description'=>$detail->visualInspiredby->name,'section'=>'no DATA');
			
			}
		}if(!empty($this->person->userVolunteerisms)){
			$this->progress+= 5;
			$this->nuggets['userVolunteerisms'] ='Volunteerisms/Comunity';
					$vdetails = $this->person->userVolunteerisms->userVolunteerismDetails;
					foreach ($vdetails as $detail){
						$this->selected_profile_category_details[AkimboNuggetManager::$span_userVolunteerisms][]= array('title'=>$this->person->userVolunteerisms->cause,'organization'=>$detail->nonprofitOrganizationCauses->nonprofitOrganization->name,'date'=>$this->person->userVolunteerisms->impact,'description'=>$detail->nonprofitOrganizationCauses->nonprofitCauses->name,'section'=>$detail->nonprofitOrganizationCauses->nonprofitOrganization->name);

					}
				}

		
		if(!empty($this->person->userStories)){
			$this->progress+= 5;
			$this->nuggets['userStories'] ='My Story';
				foreach ($this->person->userStories as $detail){
					$this->selected_profile_category_details['story'][]= array('title'=>$detail->story,'organization'=>'','date'=>Time::dateOnly($detail->create_date),'description'=>$detail->quote,'section'=>$detail->inspiration);
				}

		}
		if(!empty($this->person->scienceTechnologys)){
			$this->nuggets['scienceTechnologys'] ='Science & Technology';
			$this->progress+= 5;
			$this->profile_detail_menu['scienceTechnologys'] =  array('title'=>'Science & Technology','link'=>'profile/scienceTechnologys','span'=>'science');
				foreach ($this->person->scienceTechnologys as $detail){
					$this->selected_profile_category_details['science'][]= array('title'=>$detail->field_of_study,'organization'=>'','date'=>Time::dateOnly($detail->create_date),'description'=>$detail->inspiredby,'section'=>'$detail->scienceTechnologyDetails->project_url');
				}

			
		}
		if(!empty($this->person->userPerformingArts)){
			$this->progress+= 5;
			$this->nuggets['userPerformingArts']  ='Performing Arts';
				foreach ($this->person->userPerformingArts as $detail){
					$this->selected_profile_category_details['arts'][]= array('title'=>$detail->performArt->name,'organization'=>'','date'=>Time::dateOnly($detail->datetime),'description'=>$detail->performInspiredby->name,'section'=>'no DATA');
			
			}
		}if(!empty($this->person->userFitness)){
			$this->progress+= 5;
			$this->nuggets['userFitness'] ='Athletics/Fitness';
					foreach ($this->person->userFitness->details as $detail){

						if(!empty($detail->collegeTeams)){

							$this->selected_profile_category_details['fitness'][]= array('title'=>$detail->collegeTeams->name,'organization'=>'','date'=>$detail->collegeTeams->description,'description'=>$detail->collegeTeams->college->name,'section'=>$detail->collegeTeams->college->location);

						}
						if(!empty($detail->schoolTeams)){

							$this->selected_profile_category_details['fitness'][]= array('title'=>$detail->schoolTeams->name,'organization'=>'','date'=>$detail->schoolTeams->description,'description'=>$detail->schoolTeams->school->name,'section'=>$detail->schoolTeams->school->location);

						}

						if(!empty($detail->otherTeams)){

							$this->selected_profile_category_details['fitness'][]= array('title'=>$detail->otherTeams->name,'organization'=>'','date'=>$detail->otherTeams->description,'description'=>$detail->otherTeams->other->name,'section'=>$detail->otherTeams->other->location);

						}

					}
				
			
		}if(!empty($this->person->userDesignTechnology)){
			$this->progress+= 5;
			$this->nuggets['userDesignTechnology'] ='Design & Technology';
				$title=' ';
				if(!empty($this->person->userDesignTechnology)){
					foreach ($this->person->userDesignTechnology as $detail){
						$this->selected_profile_category_details['design'][]= array('title'=>$title,'organization'=>$detail->designTechnology->name,'date'=>Time::dateOnly($detail->modified_date),'description'=>$detail->designer_inspired_by,'section'=>'no DATA');
					}

			}
		}
		if(!empty($this->person->userWritingLiterature)){
			$this->progress+= 5;
			$this->nuggets['userWritingLiterature'] ='Writing/Literature';
				$title='';
				if(!empty($this->person->userWritingLiterature)){
					foreach ($this->person->userWritingLiterature as $detail){

						if(!empty($detail->userReadBooks)){
							foreach ($detail->userReadBooks as $readBooks)
								$this->selected_profile_category_details[AkimboNuggetManager::$span_userWritingLiterature][]= array('title'=>$readBooks->book->name,'organization'=>$readBooks->book->author,'date'=>$detail->writer_inspired_by,'description'=>CHtml::image($readBooks->book->thumbnail,$readBooks->book->name),'section'=>$readBooks->book->isbn);

						}
					}

			}

		}
		if(!empty($this->person->travel)){
			$this->progress+= 5;
			$this->nuggets['travel'] ='Travel';
				$title='<span></span>';
				foreach ($this->person->travel as $traveldetail){
					$this->selected_profile_category_details['travel'][]= array('title'=>$title,'organization'=>$traveldetail->destination->name,'date'=>'','description'=>'','section'=>'');
						
			
			}
		}

		if(!empty($this->person->culinaryArts)){
			$this->nuggets['culinaryArts'] ='Culinary Arts';
			$this->progress+= 5;
				$title='Dine at ';
				foreach ($this->person->culinaryArts as $detail){
					$description = "";
					if(!empty($detail->photo_uploader)){
						
						foreach ($detail->photo_uploader as $photo){
							$description.='<div>'.CHtml::image(Yii::app()->baseUrl.$photo->location.$photo->name,$photo->name,array('class'=>'avatar','width'=>'70','height'=>'70')).'</div>';
							
						}
						
					}
					$this->selected_profile_category_details['culinary'][]= array('title'=>$title,'organization'=>$detail->name	,'date'=>$detail->inspiredby,'description'=>$description,'section'=>'');
				}

			
		}


	}

	public function getProfileDetailMenu(){
		return $this->profile_detail_menu;
	}

	public function getProfileProgress(){
		return $this->progress;
	}

	public function getSelectedProfileCategoryDetails(){
		return $this->selected_profile_category_details;
	}

	public function  getSelectedProfileCategoryTitle(){
		return $this->title;
	}

	public function  getSelectedProfileCategorySelectName(){
		return $this->selected;
	}

	public static function getProfileNuggets(){

		$nuggets = array();
		$nuggets['workexperience'] ='Work Experience';
		$nuggets['Academics']='Academics';
		$nuggets['userAwards']='Awards/Recognitions';
		$nuggets['userAboutMe'] ='About Me';
		$nuggets['businessIntrepreneurships'] ='Business/Intrepreneurships';
		$nuggets['userMusics'] ='Music';
		$nuggets['userMilitaryServices'] ='Military Service';
		$nuggets['userVisualArts'] ='Visual Arts';
		$nuggets['userVolunteerisms'] ='Volunteerisms/Comunity';
		$nuggets['userStories'] ='My Story';
		$nuggets['scienceTechnologys'] ='Science & Technology';
		$nuggets['userPerformingArts']  ='Performing Arts';
		$nuggets['userFitness'] ='Athletics/Fitness';
		$nuggets['userDesignTechnology'] ='Design & Technology';
		$nuggets['userWritingLiterature'] ='Writing/Literature';
		$nuggets['travel'] ='Travel';
		$nuggets['culinaryArts'] ='Culinary Arts';

		return $nuggets;

	}

	public function getFilledProfileNuggets(){

		return $this->nuggets;
	}

	public function getFilledProfileNuggetsForRecomendation(){

		unset($this->nuggets['userAboutMe']);
	 return $this->nuggets;
	}




}
?>
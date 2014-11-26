<?php
class AkimboSearch extends Person{

	private $filtersArray = array();
	private $filtersValueArray = array();
	public $limit = 10;
	const myName = 'AkimboSearch';
	public $page = 'AkimboSearch_page';
	const myParentName = 'Person';
	
	
	
	public function getFiltersArray(){
		return $this->filtersArray;
	}
	


	public function setLimit($limit){
		$this->limit = $limit;

	}


	public function createFiltersFromActiveForm($post = array()){

		foreach ($post as $key=>$value){
			if($key !== self::myName && $key !== self::myParentName && $key !== 'r' && $key !== 'ajax' && $key !== $this->page && is_array($value)){
				foreach ($value as $index=>$val){
					if(!empty($val)){
						$this->filtersArray[$key][]= $index;
						$this->filtersValueArray[$key][$index]= $val;

					}
				}
			}
			else{
				
				//echo "<br> the key is $key";
			}

		}
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */



	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$searchCriteria = new CDbCriteria();

		$criteria->limit = $this->limit;
		$searchCriteria->with = array('companys' => array(
				'with' => array('companyDetails','industry')),
				'userDetails',
				'userAcademics' => array(
						'with' => array('majorSubject','minorSubject')),
				'userWorkExperiences' => array(
						'with' => array('sector')),
				'userAboutMe','userAwards',
				'userFitness' => array(
						'with' => array('details'=>array('with'=>array('collegeTeams','schoolTeams','otherTeams')))),
				'culinaryArts',
				'userDesignTechnology' => array(
						'with' => array('designTechnology')),
				'userWritingLiterature' => array(
						'with' => array('userReadBooks'=>array('with'=>array('book')))),
				'travel' => array(
						'with' => array('destination')),
				'userPerformingArts' => array(
						'with' => array('performInspiredby','performArt')),
				'userVisualArts' => array(
						'with' => array('visualInspiredby','visualArt')),
				'userMilitaryServices' => array(
						'with' => array('branch')),
				'userVolunteerisms' => array(
						'with' => array('userVolunteerismDetails'=>array('with'=>array('nonprofitOrganizationCauses'=>array('with'=>array('nonprofitOrganization','nonprofitCauses')),)))),
				'businessIntrepreneurships','userStories',
				'userMusics' => array(
						'with' => array('userMusicDetails'=>array('with'=>array('field')))),

		);



		$searchCriteria->group = 't.email';


		// setting filters and advance search parameters if set



		// for user details table
		
		if(!empty($this->role_id)){
			$searchCriteria->compare('role_id',$this->role_id);
		}
		
		
		

		if(!empty($this->filtersArray['UserDetails'])){
			if (in_array('first_name', $this->filtersArray['UserDetails'], true)) {
				$searchCriteria->compare('userDetails.first_name',$this->filtersValueArray['UserDetails']['first_name']);

			}

			else $criteria->compare('userDetails.first_name',$this->keyword,true,"OR");

			if (in_array('last_name', $this->filtersArray['UserDetails'], true)) {
				$searchCriteria->compare('userDetails.last_name',$this->filtersValueArray['UserDetails']['last_name']);
			}
			else $criteria->compare('userDetails.last_name',$this->keyword,true,"OR");


			if (in_array('country', $this->filtersArray['UserDetails'], true)) {

				$searchCriteria->compare('userDetails.country',$this->filtersValueArray['UserDetails']['country']);
			}

			else $criteria->compare('userDetails.country',$this->keyword,true,"OR");

		}
		else{

			$criteria->compare('userDetails.first_name',$this->keyword,true,"OR");
			$criteria->compare('userDetails.last_name',$this->keyword,true,"OR");
			$criteria->compare('userDetails.country',$this->keyword,true,"OR");
		}
			
		$criteria->compare('userDetails.state',$this->keyword,true,"OR");
		$criteria->compare('userDetails.city',$this->keyword,true,"OR");


		// for company
			
		if(!empty($this->filtersArray['Company'])){
			if (in_array('name', $this->filtersArray['Company'], true)) {

				$searchCriteria->compare('companys.name',$this->filtersValueArray['Company']['name']);
			}

			else $criteria->compare('companys.name',$this->keyword,true,"OR");


		}
			
			
		else{


			$criteria->compare('companys.name',$this->keyword,true,"OR");
		}
			
			
			
		// for UserWorkExperience'
			
		if(!empty($this->filtersArray['UserWorkExperience'])){
			if (in_array('title', $this->filtersArray['UserWorkExperience'], true)) {
					
				$searchCriteria->compare('userWorkExperiences.title',$this->filtersValueArray['UserWorkExperience']['title']);
			}

			else $criteria->compare('userWorkExperiences.title',$this->keyword,true,"OR");
				
			if (in_array('organization', $this->filtersArray['UserWorkExperience'], true)) {
					
				$searchCriteria->compare('userWorkExperiences.organization',$this->filtersValueArray['UserWorkExperience']['organization']);
			}
				
			else $criteria->compare('userWorkExperiences.organization',$this->keyword,true,"OR");
				


		}
		else{
				
			$criteria->compare('userWorkExperiences.organization',$this->keyword,true,"OR");
			$criteria->compare('userWorkExperiences.title',$this->keyword,true,"OR");
				
		}

		// for schools

		if(!empty($this->filtersArray['UserAcademic'])){
			if (in_array('school', $this->filtersArray['UserAcademic'], true)) {

				//$searchCriteria->compare('userAcademics.school',$this->filtersValueArray['UserAcademic']['school']);

			}

			else $criteria->compare('userAcademics.school',$this->keyword,true,"OR");


		}
		else{
				
			$criteria->compare('userAcademics.school',$this->keyword,true,"OR");
				
		}

		$criteria->compare('majorSubject.name',$this->keyword,true,"OR");
		$criteria->compare('majorSubject.description',$this->keyword,true,"OR");

		$criteria->compare('minorSubject.name',$this->keyword,true,"OR");
		$criteria->compare('minorSubject.description',$this->keyword,true,"OR");
			
			
			
		$criteria->compare('companyDetails.email',$this->keyword,true,"OR");
		$criteria->compare('companyDetails.country',$this->keyword,true,"OR");
		$criteria->compare('companyDetails.state',$this->keyword,true,"OR");
		$criteria->compare('companyDetails.city',$this->keyword,true,"OR");
		$criteria->compare('industry.name',$this->keyword,true,"OR");
			

		$criteria->compare('culinaryArts.name',$this->keyword,true,"OR");
		$criteria->compare('culinaryArts.inspiredBy',$this->keyword,true,"OR");
		$criteria->compare('designTechnology.name',$this->keyword,true,"OR");


		$criteria->compare('userAboutMe.objective',$this->keyword,true,"OR");
		$criteria->compare('userAwards.description',$this->keyword,true,"OR");
		$criteria->compare('userAwards.award',$this->keyword,true,"OR");
		$criteria->compare('schoolTeams.name',$this->keyword,true,"OR");
		$criteria->compare('schoolTeams.description',$this->keyword,true,"OR");
		$criteria->compare('collegeTeams.name',$this->keyword,true,"OR");
		$criteria->compare('collegeTeams.description',$this->keyword,true,"OR");
		$criteria->compare('otherTeams.name',$this->keyword,true,"OR");
		$criteria->compare('otherTeams.description',$this->keyword,true,"OR");
		$criteria->compare('userWritingLiterature.writer_inspired_by',$this->keyword,true,"OR");
		$criteria->compare('book.name',$this->keyword,true,"OR");
		$criteria->compare('book.author',$this->keyword,true,"OR");
		$criteria->compare('book.isbn',$this->keyword,true,"OR");
		$criteria->compare('destination.name',$this->keyword,true,"OR");
		$criteria->compare('visualInspiredby.name',$this->keyword,true,"OR");
		$criteria->compare('visualArt.name',$this->keyword,true,"OR");
		$criteria->compare('performInspiredby.name',$this->keyword,true,"OR");
		$criteria->compare('performArt.name',$this->keyword,true,"OR");

		//military
		$criteria->compare('userMilitaryServices.devision',$this->keyword,true,"OR");
		$criteria->compare('userMilitaryServices.rank',$this->keyword,true,"OR");
		$criteria->compare('branch.name',$this->keyword,true,"OR");
		$criteria->compare('branch.description',$this->keyword,true,"OR");

		//volunteerism
		$criteria->compare('userVolunteerisms.cause',$this->keyword,true,"OR");
		$criteria->compare('userVolunteerismDetails.link',$this->keyword,true,"OR");
		$criteria->compare('nonprofitOrganization.name',$this->keyword,true,"OR");
		$criteria->compare('nonprofitCauses.name',$this->keyword,true,"OR");

		//business
		$criteria->compare('businessIntrepreneurships.ventures',$this->keyword,true,"OR");
		$criteria->compare('businessIntrepreneurships.relevant_business_projects',$this->keyword,true,"OR");
		$criteria->compare('userStories.story',$this->keyword,true,"OR");
		$criteria->compare('userStories.quote',$this->keyword,true,"OR");
		$criteria->compare('userStories.inspiration',$this->keyword,true,"OR");
		$criteria->compare('userStories.impact',$this->keyword,true,"OR");
		$criteria->compare('userMusics.inspired_by',$this->keyword,true,"OR");
		$criteria->compare('field.name',$this->keyword,true,"OR");
		$criteria->compare('userMusics.inspired_by',$this->keyword,true,"OR");

		$searchCriteria->mergeWith($criteria,true);
		$searchCriteria->together=true;

		$sort = new CSort;
		$sort->attributes = array(
				'companys.name' => array(
						'asc' => 'companys.name, email',
						'desc' => 'companys.name DESC, email DESC',
				),
				'*',
				'schoolTeams.name' => array(
						'asc' => 'schoolTeams.name, email',
						'desc' => 'schoolTeams.name DESC, email DESC',
				),
				'*',
				'userAcademics.school' => array(
						'asc' => 'userAcademics.school, email',
						'desc' => 'userAcademics.school DESC, email DESC',
				),
				'*',
		);
		return new CActiveDataProvider(get_class($this), array(
				'pagination'=>array(
						//
						// please check how we get the
						// the pageSize from user's state
						'pageSize'=> $this->limit,

						//
						// we have previously set defaultPageSize
						// on the params section of our main.php config file
						//Yii::app()->params['defaultPageSize']),
				),
				'criteria'=>$searchCriteria,
				'sort'=>$sort,
		));

	}





}
?>
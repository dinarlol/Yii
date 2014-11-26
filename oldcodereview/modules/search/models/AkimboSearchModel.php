<?php
class AkimboSearchModel extends Person{

	public $limit = 10;

	public $first_name;
	public $last_name;
	public $country;
	public $company_name;
	public $userWorkExperiences_title;
	public $userWorkExperiences_organization;
	public $userAcademics_school;
	public $user_type;




	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('first_name,last_name, country, company_name, userWorkExperiences_title, userWorkExperiences_organization, userAcademics_school, user_type', 'length', 'max'=>95),
			
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('first_name, last_name, country, company_name, userWorkExperiences_title, userWorkExperiences_organization, userAcademics_school, user_type', 'safe', 'on'=>'search'),
		);
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
		$criteria->with = array('companys' => array(
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



		$criteria->group = 't.email';


		// setting filters and advance search parameters if set



		// for user details table

		//$criteria->compare('role_id',$this->role_id);


		if(!empty($this->first_name)){
			$criteria->compare('userDetails.first_name',$this->first_name,true);
		}
else
		$criteria->compare('userDetails.first_name',$this->keyword,true,"OR");
		
		
		if(!empty($this->last_name))
			$criteria->compare('userDetails.last_name',$this->last_name,true);
		else
			$criteria->compare('userDetails.last_name',$this->last_name,true,"OR");
		
		if(!empty($this->country))
		$criteria->compare('userDetails.country',$this->country);
		else $criteria->compare('userDetails.country',$this->country,true,"OR");	
		
		
		$criteria->compare('userDetails.state',$this->keyword,true,"OR");
		$criteria->compare('userDetails.city',$this->keyword,true,"OR");
		
		//company
		
		if(!empty($this->company_name))
			$criteria->compare('companys.name',$this->company_name);
		else $criteria->compare('companys.name',$this->keyword,true,"OR");
		
		
		
		//echo $this->first_name;exit;
		/*$criteria->compare('userDetails.first_name',$this->first_name,true);
		$criteria->compare('userDetails.last_name',$this->last_name,true);
		$criteria->compare('userDetails.country',$this->country,true);
		$criteria->compare('companys.name',$this->company_name,true);
		*/
		// for UserWorkExperience'
		
		
		if(!empty($this->userWorkExperiences_title))
			$criteria->compare('userWorkExperiences.title',$this->userWorkExperiences_title);
		else	$criteria->compare('userWorkExperiences.title',$this->keyword,true,"OR");
		
		if(!empty($this->userWorkExperiences_organization))
			$criteria->compare('userWorkExperiences.organization',$this->userWorkExperiences_organization);
		else	$criteria->compare('userWorkExperiences.organization',$this->keyword,true,"OR");
		
		// for schools
		
		
		if(!empty($this->userAcademics_school))
			$criteria->compare('userAcademics.school',$this->keyword);
		else	$criteria->compare('userAcademics.school',$this->keyword,true,"OR");
		


		
		$criteria->compare('userWorkExperiences.title',$this->userWorkExperiences_title,true);
		$criteria->compare('userWorkExperiences.organization',$this->userWorkExperiences_organization,true);
		$criteria->compare('userAcademics.school',$this->userAcademics_school,true);
		
		

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

		$criteria->together=true;
		//print_r($criteria);exit;

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
				'criteria'=>$criteria,
				'sort'=>$sort,
		));

	}





}
?>
<?php

/**
 * This is the model class for Company extended a Person object
 *
 * The followings are the available columns in table 'ak_user':
 * @property integer $id
 * @property integer $group_id
 * @property integer $role_id
 * @property string $email
 * @property string $password
 * @property string $status
 * @property string $lng
 * @property string $lat
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property Company[] $companys
 * @property Group $group
 * @property Roles $role
 */
class Employee extends Person
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, role_id, email, password, status, create_date, modified_date', 'required'),
			array('group_id, role_id', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>75),
			array('password', 'length', 'max'=>95),
			array('status', 'length', 'max'=>9),
			array('lng, lat', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id, role_id, email, password, status, lng, lat, create_date, modified_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'professions' => array(self::HAS_MANY, 'Profession', 'user_id'),
				'scienceTechnologys' => array(self::HAS_MANY, 'ScienceTechnology', 'user_id'),
				'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
				'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
				'userAboutMe' => array(self::HAS_ONE, 'UserAboutMe', 'user_id'),
				'userAcademics' => array(self::HAS_MANY, 'UserAcademic', 'user_id'),
				'userAwards' => array(self::HAS_MANY, 'UserAwards', 'user_id'),
				'userContacts' => array(self::HAS_MANY, 'UserContact', 'user_id'),
				'userDetails' => array(self::HAS_ONE, 'UserDetails', 'user_id'),
				'userFitness' => array(self::HAS_ONE, 'UserFitness', 'user_id'),
				'userHobbies' => array(self::HAS_MANY, 'UserHobbies', 'user_id'),
				'userDesignTechnology' => array(self::HAS_MANY, 'UserDesign', 'user_id'),
				'userLookingFors' => array(self::HAS_MANY, 'UserLookingFor', 'user_id'),
				'userMilitaryServices' => array(self::HAS_MANY, 'UserMilitaryService', 'user_id'),
				'userMusics' => array(self::HAS_MANY, 'UserMusic', 'user_id'),
				'userStories' => array(self::HAS_MANY, 'UserStory', 'user_id'),
				'businessIntrepreneurships' => array(self::HAS_MANY, 'BusinessIntrepreneurship', 'user_id'),
				'userVolunteerisms' => array(self::HAS_ONE, 'UserVolunteerism', 'user_id'),
				'userVisualArts' => array(self::HAS_MANY, 'UserVisualArts', 'user_id'),
				'userPerformingArts' => array(self::HAS_MANY, 'UserPerformingArts', 'user_id'),
				'userWorkExperiences' => array(self::HAS_MANY, 'UserWorkExperience', 'user_id'),
				'travel' => array(self::HAS_MANY, 'UserTravel', 'user_id'),
				'culinaryArts' => array(self::HAS_MANY, 'CulinaryArts', 'user_id'),
				'userWritingLiterature' => array(self::HAS_MANY, 'UserWritingLiterature', 'user_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => 'Group',
			'role_id' => 'Role',
			'email' => 'Email',
			'password' => 'Password',
			'status' => 'Status',
			'lng' => 'Lng',
			'lat' => 'Lat',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
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
		
		/*
		 * 
		 * 
		 * array('userDetails','userAcademics','userWorkExperiences','userAboutMe','userAwards','userFitness.details.collegeTeams','userFitness.details.schoolTeams','userFitness.details.otherTeams'
				,'culinaryArts','userDesignTechnology.designTechnology','userWritingLiterature','userWritingLiterature.userReadBooks.book','travel.destinations'
				,'userPerformingArts.performInspiredby','userPerformingArts.performArt','userVisualArts.visualInspiredby','userVisualArts.visualArt'
				,'userMilitaryServices.branch','userVolunteerisms','userVolunteerisms.userVolunteerismDetails'
				,'userVolunteerisms.userVolunteerismDetails.nonprofitOrganizationCauses.nonprofitCauses','userVolunteerisms.userVolunteerismDetails.nonprofitOrganizationCauses.nonprofitOrganization'
				,'businessIntrepreneurships','userStories','userMusics','userMusics.field','userMusics.artist');
		 * 
		 * 
		 * 
		 * 
		 * 
		 * 
		 * $criteria->with = array('role','userDetails'=>array('together'=>true),'userAcademics'=>array('together'=>true),'userWorkExperiences'=>array('together'=>true),'userAboutMe','userAwards','userFitness.details.collegeTeams','userFitness.details.schoolTeams','userFitness.details.otherTeams'
				,'culinaryArts','userDesignTechnology.designTechnology','userWritingLiterature','userWritingLiterature.userReadBooks.book','travel.destinations'
				,'userPerformingArts.performInspiredby','userPerformingArts.performArt','userVisualArts.visualInspiredby','userVisualArts.visualArt'
				,'userMilitaryServices.branch','userVolunteerisms','userVolunteerisms.userVolunteerismDetails'
				,'userVolunteerisms.userVolunteerismDetails.nonprofitOrganizationCauses.nonprofitCauses','userVolunteerisms.userVolunteerismDetails.nonprofitOrganizationCauses.nonprofitOrganization'
				,'businessIntrepreneurships','userStories','userMusics','userMusics.field','userMusics.artist');
		 */
		
		
		

		$criteria=new CDbCriteria;
		$criteria->limit = 10;
		$criteria->with = array('role','userDetails','userAcademics','userAcademics.majorSubject','userAcademics.minorSubject','userWorkExperiences','userAboutMe','userAwards','userFitness.details.collegeTeams','userFitness.details.schoolTeams','userFitness.details.otherTeams'
				,'culinaryArts','userDesignTechnology.designTechnology','userWritingLiterature','userWritingLiterature.userReadBooks.book','travel.destinations'
				,'userPerformingArts.performInspiredby','userPerformingArts.performArt','userVisualArts.visualInspiredby','userVisualArts.visualArt'
				,'userMilitaryServices','userMilitaryServices.branch','userVolunteerisms','userVolunteerisms.userVolunteerismDetails'
				,'userVolunteerisms.userVolunteerismDetails.nonprofitOrganizationCauses.nonprofitCauses','userVolunteerisms.userVolunteerismDetails.nonprofitOrganizationCauses.nonprofitOrganization'
				,'businessIntrepreneurships','userStories','userMusics','userMusics.field','userMusics.artist');
		$criteria->group = 'email';
		$criteria->compare('role.name',$this->userRole);
		$criteria->compare('email',$this->keyword,true);
		
		$criteria->compare('userDetails.first_name',$this->keyword,true,"OR");
		$criteria->compare('userDetails.last_name',$this->keyword,true,"OR");
		$criteria->compare('userDetails.country',$this->keyword,true,"OR");
		$criteria->compare('userDetails.state',$this->keyword,true,"OR");
		$criteria->compare('userDetails.city',$this->keyword,true,"OR");
		
		$criteria->compare('userAcademics.concentration',$this->keyword,true,"OR");
		$criteria->compare('userAcademics.school',$this->keyword,true,"OR");
		$criteria->compare('majorSubject.name',$this->keyword,true,"OR");
		$criteria->compare('majorSubject.description',$this->keyword,true,"OR");
		$criteria->compare('minorSubject.name',$this->keyword,true,"OR");
		$criteria->compare('minorSubject.description',$this->keyword,true,"OR");
		
		$criteria->compare('userWorkExperiences.organization',$this->keyword,true,"OR");
		$criteria->compare('userWorkExperiences.title',$this->keyword,true,"OR");
		$criteria->compare('userAboutMe.objective',$this->keyword,true,"OR");
		
		$criteria->compare('userAwards.award',$this->keyword,true,"OR");
		$criteria->compare('userAwards.description',$this->keyword,true,"OR");
		
		$criteria->compare('collegeTeams.name',$this->keyword,true,"OR");
		$criteria->compare('collegeTeams.description',$this->keyword,true,"OR");
		$criteria->compare('schoolTeams.name',$this->keyword,true,"OR");
		$criteria->compare('schoolTeams.description',$this->keyword,true,"OR");
		$criteria->compare('otherTeams.name',$this->keyword,true,"OR");
		$criteria->compare('otherTeams.description',$this->keyword,true,"OR");
		
		$criteria->compare('culinaryArts.name',$this->keyword,true,"OR");
		$criteria->compare('culinaryArts.inspiredBy',$this->keyword,true,"OR");
		$criteria->compare('designTechnology.name',$this->keyword,true,"OR");
		
		$criteria->compare('userWritingLiterature.writer_inspired_by',$this->keyword,true,"OR");
		$criteria->compare('book.name',$this->keyword,true,"OR");
		$criteria->compare('book.author',$this->keyword,true,"OR");
		$criteria->compare('book.isbn',$this->keyword,true,"OR");
		$criteria->compare('book.website',$this->keyword,true,"OR");
		$criteria->compare('destinations.name',$this->keyword,true,"OR");
		$criteria->compare('performInspiredby.name',$this->keyword,true,"OR");
		$criteria->compare('performArt.name',$this->keyword,true,"OR");
		
		$criteria->compare('visualInspiredby.name',$this->keyword,true,"OR");
		$criteria->compare('visualArt.name',$this->keyword,true,"OR");
		
		//military 
		$criteria->compare('userMilitaryServices.devision',$this->keyword,true,"OR");
		$criteria->compare('userMilitaryServices.rank',$this->keyword,true,"OR");
		$criteria->compare('branch.name',$this->keyword,true,"OR");
		$criteria->compare('branch.description',$this->keyword,true,"OR");
		$criteria->compare('userVolunteerisms.cause',$this->keyword,true,"OR");
		$criteria->compare('userVolunteerismDetails.link',$this->keyword,true,"OR");
		$criteria->compare('nonprofitCauses.name',$this->keyword,true,"OR");
		$criteria->compare('nonprofitOrganization.name',$this->keyword,true,"OR");
		$criteria->compare('businessIntrepreneurships.ventures',$this->keyword,true,"OR");
		$criteria->compare('businessIntrepreneurships.relevant_business_projects',$this->keyword,true,"OR");
		$criteria->compare('userStories.story',$this->keyword,true,"OR");
		$criteria->compare('userStories.quote',$this->keyword,true,"OR");
		$criteria->compare('userStories.inspiration',$this->keyword,true,"OR");
		$criteria->compare('userStories.impact',$this->keyword,true,"OR");
		$criteria->compare('userMusics.inspired_by',$this->keyword,true,"OR");
		$criteria->compare('field.name',$this->keyword,true,"OR");
		$criteria->compare('artist.name',$this->keyword,true,"OR");
		
		$criteria->together=true;

		//$criteria->compare('city',$this->address,true,"OR");

		/*
		 $criteria->compare('id',$this->id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		*/		$sort = new CSort;
		$sort->attributes = array(
				'userDetails.first_name' => array(
						'asc' => 'userDetails.first_name, email',
						'desc' => 'userDetails.first_name, email DESC',
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
						'pageSize'=> '5',
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
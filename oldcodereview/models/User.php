<?php

/**
 * This is the model class for table "ak_user".
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
 * @property Profession[] $professions
 * @property ScienceTechnology[] $scienceTechnologys
 * @property Group $group
 * @property Roles $role
 * @property UserAboutMe[] $userAboutMes
 * @property UserAcademic[] $userAcademics
 * @property UserAwards[] $userAwards
 * @property UserBusiness[] $userBusinesses
 * @property UserContact[] $userContacts
 * @property UserCulinaryArts[] $userCulinaryArts
 * @property UserDesign[] $userDesigns
 * @property UserDetails[] $userDetails
 * @property UserFitness[] $userFitnesses
 * @property UserHobbies[] $userHobbies
 * @property UserLookingFor[] $userLookingFors
 * @property UserMilitaryService[] $userMilitaryServices
 * @property UserMusic[] $userMusics
 * @property UserRecomendations[] $userRecomendations
 * @property UserStory[] $userStories
 * @property UserVolunteerism[] $userVolunteerisms
 * @property UserWorkExperience[] $userWorkExperiences
 * @property UserWritingLiterature[] $userWritingLiteratures
 */
class User extends Person
{
	
	// class User
	public function getFullName() {
		if($this->role->name === $this->userRole){
			if(!empty($this->userDetails)){
				return $this->userDetails->first_name." ".$this->userDetails->last_name;
			}
			else{
				
				//print_r($this->role);exit;
			}
			
		}
		else if($this->role->name === $this->companyRole){
			if(!empty($this->companys)){
				return $this->companys->name;
			}
			else{
				
				//print_r($this->role);exit;
			}
			
		}
		
		return 'invisible';
	}
	
	public function getSuggest($keyword) {
		$criteria = new CDbCriteria();
		$criteria->with = array('companys','userDetails');
		$criteria->group = 't.email';
		$criteria->compare('t.email',$keyword,true);
		$criteria->compare('userDetails.first_name',$keyword,true,"OR");
		$criteria->compare('userDetails.last_name',$keyword,true,"OR");
		$criteria->compare('companys.name',$this->keyword,true,"OR");
		return $this->findAll($criteria);
	}
	
	
	
	
	}
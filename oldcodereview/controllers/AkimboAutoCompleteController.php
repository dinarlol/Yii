<?php

class AkimboAutoCompleteController extends Controller
{


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('companyName','userFirstName','userLastName','userWorkExperienceTitle','userAcademicsShool','organizationName','userFullNameWithId'),
						'roles'=>array(AkimboNuggetManager::USER_ROLE,AkimboNuggetManager::COMPANY_ROLE),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}




	public function actionCompanyName(){

		if(Yii::app()->request->isAjaxRequest && isset($_GET['term']))
		{
			$name = $_GET['term'];
			$criteria = new CDbCriteria;
			$criteria->condition = "name LIKE :nameTerm";
			$criteria->params = array(":nameTerm"=>"%$name%");
			$criteria->distinct = true;
			$criteria->group = 't.name';
			$companyArray = Company::model()->findAll($criteria);
			$returnVal = array();
			foreach($companyArray as $company)
			{
				$returnVal[] = array('label'=>$company->getAttribute('name'),'value'=>$company->getAttribute('name'),);
				 
			}

			echo CJSON::encode($returnVal);
			Yii::app()->end();
		}

	}
	
	
	
	public function actionOrganizationName(){
	
		if(Yii::app()->request->isAjaxRequest && isset($_GET['term']))
		{
			$name = $_GET['term'];
			$criteria = new CDbCriteria;
			$criteria->condition = "organization LIKE :nameTerm";
			$criteria->params = array(":nameTerm"=>"%$name%");
			$criteria->distinct = true;
			$criteria->group = 't.organization';
			$userArray = UserWorkExperience::model()->findAll($criteria);
			$returnVal = array();
			foreach($userArray as $user)
			
			{
				$returnVal[] = array('label'=>$user->getAttribute('organization'),'value'=>$user->getAttribute('organization'),);
	
			}
	
			echo CJSON::encode($returnVal);
			Yii::app()->end();
		}
	
	}
	
	public function actionUserFirstName(){
	
		if(Yii::app()->request->isAjaxRequest && isset($_GET['term']))
		{
			$name = $_GET['term'];
			$criteria = new CDbCriteria;
			$criteria->condition = "first_name LIKE :nameTerm";
			$criteria->params = array(":nameTerm"=>"%$name%");
			$criteria->distinct = true;
			$criteria->group = 't.first_name';
			$userArray = UserDetails::model()->findAll($criteria);
			$returnVal = array();
			foreach($userArray as $user)
			{
				$returnVal[] = array('label'=>$user->getAttribute('first_name'),'value'=>$user->getAttribute('first_name'),);
	
			}
	
			echo CJSON::encode($returnVal);
			Yii::app()->end();
		}
	
	}
	
	public function actionUserFullNameWithId(){
	
		if(Yii::app()->request->isAjaxRequest && isset($_GET['term']))
		{
			$name = $_GET['term'];
			$criteria = new CDbCriteria;
			$criteria->condition = "first_name LIKE :nameTerm OR last_name LIKE :nameTerm";
			$criteria->params = array(":nameTerm"=>"%$name%");
			$criteria->distinct = true;
			$criteria->group = 't.first_name';
			$userArray = UserDetails::model()->findAll($criteria);
			$returnVal = array();
			foreach($userArray as $user)
			{
				$fullname = $user->getAttribute('first_name')." ".$user->getAttribute('last_name');
				$returnVal[] = array('label'=>$fullname,'value'=>$fullname,'id'=>$user->user->id,);
	
			}
	
			echo CJSON::encode($returnVal);
			Yii::app()->end();
		}
	
	}
	

	
	public function actionUserLastName(){
	
		if(Yii::app()->request->isAjaxRequest && isset($_GET['term']))
		{
			$name = $_GET['term'];
			$criteria = new CDbCriteria;
			$criteria->condition = "last_name LIKE :nameTerm";
			$criteria->params = array(":nameTerm"=>"%$name%");
			$criteria->distinct = true;
			$criteria->group = 't.last_name';
			$userArray = UserDetails::model()->findAll($criteria);
			$returnVal = array();
			foreach($userArray as $user)
			{
				$returnVal[] = array('label'=>$user->getAttribute('last_name'),'value'=>$user->getAttribute('last_name'),);
	
			}
	
			echo CJSON::encode($returnVal);
			Yii::app()->end();
		}
	
	}
	
	
	public function actionUserWorkExperienceTitle(){
	
		if(Yii::app()->request->isAjaxRequest && isset($_GET['term']))
		{
			$name = $_GET['term'];
			$criteria = new CDbCriteria;
			$criteria->condition = "title LIKE :nameTerm";
			$criteria->distinct = true;
			$criteria->group = 't.title';
			$criteria->params = array(":nameTerm"=>"%$name%");
			$userArray = UserWorkExperience::model()->findAll($criteria);
			$returnVal = array();
			foreach($userArray as $user)
			{
				$returnVal[] = array('label'=>$user->getAttribute('title'),'value'=>$user->getAttribute('title'),);
	
			}
	
			echo CJSON::encode($returnVal);
			Yii::app()->end();
		}
	
	}
	
	public function actionUserAcademicSchool(){
	
		if(Yii::app()->request->isAjaxRequest && isset($_GET['term']))
		{
			$name = $_GET['term'];
			$criteria = new CDbCriteria;
			$criteria->condition = "school LIKE :nameTerm";
			$criteria->distinct = true;
			$criteria->group = 't.school';
			$criteria->params = array(":nameTerm"=>"%$name%");
			$userArray = UserAcademic::model()->findAll($criteria);
			$returnVal = array();
			foreach($userArray as $user)
			{
				$returnVal[] = array('label'=>$user->getAttribute('school'),'value'=>$user->getAttribute('school'),);
	
			}
	
			echo CJSON::encode($returnVal);
			Yii::app()->end();
		}
	
	}







}
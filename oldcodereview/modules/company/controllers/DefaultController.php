<?php

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
	public $portlets = array('RecentUploads'=>array(),'RecentRecomendation'=>array(),'RecentSiteMatrics'=>array());



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
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('index'),
						'roles'=>array(AkimboNuggetManager::COMPANY_ROLE),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('potentialEmployerAdd','potentialEmployerRemove'),
						'roles'=>array(AkimboNuggetManager::USER_ROLE),
				),

				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'roles'=>array(AkimboNuggetManager::COMPANY_ROLE),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('profile'),
						'roles'=>array(AkimboNuggetManager::COMPANY_ROLE,AkimboNuggetManager::USER_ROLE),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}


	public function actionPotentialEmployerAdd(){

		
		if(isset($_GET['employer_id'])){
			$criteria = new CDbCriteria();
			$criteria->compare('user_id',Yii::app()->user->id);
			$criteria->compare('employer_id',$_GET['employer_id']);
			$potentialEmployee = UserPotentialEmployer::model()->find($criteria);
			if(empty($potentialEmployee)){
				
			$potentialEmployee = new UserPotentialEmployer();
			$potentialEmployee->employer_id = $_GET['employer_id'];
			$potentialEmployee->user_id = Yii::app()->user->id;
			$potentialEmployee->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$potentialEmployee->modified_date = $potentialEmployee->create_date;
			if($potentialEmployee->save()){
				$this->renderPartial('potential_employer',array('assign' =>'add'),false,true);
				
			}
			else{
				
			}
		}
		else{
			
			$this->renderPartial('potential_employer',array('assign' =>'add'),false,true);
			
		}
	}
	
	}

	public function actionPotentialEmployerRemove(){

		if(isset($_GET['employer_id'])){
			$criteria = new CDbCriteria();
			$criteria->compare('user_id',Yii::app()->user->id);
			$criteria->compare('employer_id',$_GET['employer_id']);
			$potentialEmployee = UserPotentialEmployer::model()->find($criteria);
			if(!empty($potentialEmployee)){
			if($potentialEmployee->delete()){
				$this->renderPartial('potential_employer',array('assign' =>'remove'),false,true);
						
			}
			}
		}
	}


	public function actionProfile()
	{

		$id = null;
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else {$person = Person::model()->findByPk(Yii::app()->user->id);
		$id = $person->id;
		}
		if(Yii::app()->user->id !== $person->id){
		
		
			$siteMatrics = new UsersSiteMatrics();
			$siteMatrics->visitor_user_id = Yii::app()->user->id;
			$siteMatrics->owner_user_id = $person->id;
			$siteMatrics->location = 'UKNOWN';
			$date = date('Y-m-d H:i:s');
			$siteMatrics->create_date = $date;
			$siteMatrics->activity_id = UsersActivity::model()->find('name=?',array('employee_profile'))->id;
			$siteMatrics->save();
		}


		$companyProfile = new CompanyProfile($person);
		$this->render('topinfo',array(
				'person'=>$person,
				'details' =>$companyProfile->getProfileNuggetsDetail(),
		));
			
	}


	public function actionIndex()
	{

		$this->redirect("?r=company/details");
	}

}
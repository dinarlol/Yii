<?php

class ProfileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $portlets = array();
	public $layout='//layouts/column2';

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
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('viewprofile','writingliterature','designtechnology','fitness','performingarts','visualarts','culinaryarts','travel','businessintrepreneurships','create','update','index','view','workexperience','academics','awards','aboutme','music','militaryService','volunteerisms','story','scienceTechnologys'),
						'roles'=>array(AkimboNuggetManager::USER_ROLE),
				),

				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete','nuggetsfield'),
						'roles'=>array(AkimboNuggetManager::USER_ROLE),
				),
				
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('index'),
						'roles'=>array(AkimboNuggetManager::COMPANY_ROLE),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}


	public function actionAdmin()
	{
		$model=new UserDetails('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Person']))
			$model->attributes=$_GET['Person'];
		$this->render('admin',array(
				'model'=>$model,
		));
	}

	public function actionWorkExperience(){

		$details = array();
		if(isset($_GET['id']))
			$person = Person::model()->findByPk($_GET['id']);
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		$selected = 'work';
		$title = 'Work Experience';
		if(!empty($person->userWorkExperiences)){
				
			foreach ($person->userWorkExperiences as $detail){
				$details[] = array('title'=>$detail->organization,'date'=>$detail->end_date,'description'=>$detail->title,'section'=>$detail->sector_id);
			}
		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionAcademics(){
		$selected = 'academic';
		$title = 'Academics';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userWorkExperiences)){
			$title = 'Academics';
			foreach ($person->userAcademics as $detail){
				$details[] = array('title'=>$detail->school,'date'=>$detail->graduation_date,'description'=>$detail->majorSubject->description,'section'=>$detail->majorSubject->name);
			}
		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionAwards(){
		$selected = 'awards';
		$title='Awards/Recognitions';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userAwards)){
			$title = 'Awards';
			foreach ($person->userAwards as $detail){
				$details[] = array('title'=>$detail->award,'date'=>$detail->date,'description'=>$detail->description,'section'=>'Award');
			}
				
				
		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionAboutMe(){

		$selected = 'about';
		$title = 'About Me';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userAboutMe)){
			$title = 'User About Me';
				
			$details[] = array('title'=>'About Me','date'=>$person->userAboutMe->modified_date,'description'=>$person->userAboutMe->objective,'section'=>$person->userAboutMe->create_date);
				
		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionMusic(){
		$selected = 'music';
		$title = 'Music';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userMusics)){
			$title = 'User Music';
			foreach ($person->userMusics as $detail){
				$details[] = array('title'=>$detail->inspired_by,'date'=>$detail->field->name,'description'=>$detail->inspired_by,'section'=>$detail->artist->name);
			}
		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionMilitaryService(){
		$selected = 'military';
		$title = 'Military Service';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userMilitaryServices)){
			$title = 'Military Service';
			foreach ($person->userMilitaryServices as $detail){
				$details[] = array('title'=>$detail->devision,'date'=>$detail->rank,'description'=>$detail->branch->description,'section'=>$detail->branch->name);
			}
		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionVolunteerisms(){
		$selected = 'community';
		$title= 'Volunteerisms/Comunity';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userVolunteerisms)){
			$vdetails = $person->userVolunteerisms->userVolunteerismDetails;
			foreach ($vdetails as $detail){
				$details[] = array('title'=>$person->userVolunteerisms->cause,'date'=>$person->userVolunteerisms->impact,'description'=>$detail->nonprofitOrganizationCauses->nonprofitCauses->name,'section'=>$detail->nonprofitOrganizationCauses->nonprofitOrganization->name);

			}
		}
		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionStory(){
		$selected = 'story';
		$title='My Story';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userStories)){
			foreach ($person->userStories as $detail){
				$details[] = array('title'=>$detail->story,'date'=>$detail->create_date,'description'=>$detail->quote,'section'=>$detail->inspiration);
			}
		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionScienceTechnologys(){
		$selected = 'science';
		$details = array();
		$title='Science & Technology';
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->scienceTechnologys)){
			$title = 'Science Technologys';
			foreach ($person->scienceTechnologys as $detail){
				$details[] = array('title'=>$detail->field_of_study,'date'=>$detail->create_date,'description'=>$detail->scienceTechnologyDetails->scientist_name,'section'=>$detail->scienceTechnologyDetails->project_url);
			}
		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionBusinessIntrepreneurships(){
		$selected = 'business';
		$title = 'Business/Intrepreneurships';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->businessIntrepreneurships)){
			$title = 'Business/Intrepreneurships';
			foreach ($person->businessIntrepreneurships as $detail){
				$details[] = array('title'=>$detail->name,'date'=>$detail->name,'description'=>$detail->relevant_business_projects,'section'=>$detail->upload_work);
			}
		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}

	public function actionTravel(){
		$selected = 'travel';
		$title='Travel';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->travel)){
			foreach ($person->travel as $detail){
					
				$details[] = array('title'=>$detail->destinations->name,'date'=>'','description'=>'','section'=>'');
			}

		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}

	public function actionCulinaryArts(){
		$selected = 'culinary';
		$title='Culinary Arts';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->culinaryArts)){
			foreach ($person->culinaryArts as $detail){
				$details[] = array('title'=>$detail->name,'date'=>$detail->upload,'description'=>$detail->inspiredby,'section'=>'');
			}

		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}
	public function actionVisualArts(){
		$selected = 'visual';
		$title='Visual Arts';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userVisualArts)){
			foreach ($person->userVisualArts as $detail){
				$details[] = array('title'=>$detail->visualArt->name,'date'=>$detail->datetime,'description'=>$detail->visualInspiredby->name,'section'=>'no DATA');
			}

		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}

	public function actionPerformingArts(){
		$selected = 'arts';
		$title='Performing Arts';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userPerformingArts)){
			foreach ($person->userPerformingArts as $detail){
				$details[] = array('title'=>$detail->performArt->name,'date'=>$detail->datetime,'description'=>$detail->performInspiredby->name,'section'=>'no DATA');
			}

		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}

	public function actionFitness(){
		$selected = 'fitness';
		$title='Athletics/Fitness';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userFitness)){
			foreach ($person->userFitness->details as $detail){

				if(!empty($detail->collegeTeams)){

					$details[] = array('title'=>$detail->collegeTeams->name,'date'=>$detail->collegeTeams->description,'description'=>$detail->collegeTeams->college->name,'section'=>$detail->collegeTeams->college->location);

				}
			}

		}



		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}

	public function actionWritingLiterature(){
		$selected = 'writing';
		$title='Writing/Literature';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userWritingLiterature)){
			foreach ($person->userWritingLiterature as $detail){

				if(!empty($detail->userReadBooks)){
					foreach ($detail->userReadBooks as $readBooks)
						$details[] = array('title'=>$readBooks->book->name,'date'=>$readBooks->book->author,'description'=>$readBooks->book->website,'section'=>$readBooks->book->isbn);

				}
			}

		}



		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}

	public function actionDesignTechnology(){
		$selected = 'design';
		$title='Design & Technology';
		$details = array();
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else $person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userDesignTechnology)){
			foreach ($person->userDesignTechnology as $detail){
				$details[] = array('title'=>$detail->designTechnology->name,'date'=>$detail->modified_date,'description'=>$detail->designer_inspired_by,'section'=>'no DATA');
			}

		}

		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}




	public function actionViewProfile(){

		$id = null;
		if(isset($_GET['id'])){
			$details = UserDetails::model()->findByPk($_GET['id']);
			$person = Person::model()->findByPk($details->user_id);
			$id = $details->user_id;
		}
		//else $person = Person::model()->findByPk(Yii::app()->user->id);

		$profile = new EmployeeProfile($person);

		//print_r($profile);exit;
		$this->layout='//layouts/main';
		$this->render('home/blank');
		$this->layout='//layouts/blank';
		$this->render('content_right',array(
				'person'=>$person,
		));
		$this->layout='//layouts/content_left_start';
		$this->render('topinfo',array(
				'person'=>$person,
		));
		$this->layout='//layouts/blank';
		//print_r($profile->getSelectedProfileCategoryDetails());exit;

		$this->render('maindiv',array('id'=>$id,'menu'=>$profile->getProfileDetailMenu(),'details'=>$profile->getSelectedProfileCategoryDetails(),'selected' =>$profile->getSelectedProfileCategorySelectName(),'title'=>$profile->getSelectedProfileCategoryTitle(),'progress'=>$profile->getProfileProgress()));
		$this->layout='//layouts/content_left_finish';//$this->layout='//layouts/footer';
		$this->render('home/blank');
		$this->layout='//layouts/footer';
		$this->render('home/blank');
	}

	/*
	 *
	*
	*
	*/

	public function actionNuggetsfield()
	{
		//please enter current controller name because yii send multi dim array

		$nugget = strtolower($_POST['nugget_id']);
		echo $nugget;
		$data = AkimboNuggetManager::getNuggetsBox($nugget,$_POST['user_id']);
		//$data=CHtml::listData($data,'id','school');
		print_r($data);

		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value'=>$value),CHtml::encode($name),true);
		}
	}


	public function actionIndex()
	{

		$id = null;
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
		}
		else {$person = Person::model()->findByPk(Yii::app()->user->id);
		$id = $person->id;
		}
		//$location = Yii::app()->geoip->lookupLocation();
		//print_r($location = Yii::app()->geoip->lookupLocation());
		//,'recentRecomendation'=>array(),'recentSiteMatrics'=>array()
		$this->portlets['RecomendMe'] = array('user_id'=>$id,'module'=>'employee/profile');


		if(isset($_POST['UserRecomendations']))
		{
				
			$model=new UserRecomendations;
			$model->attributes=$_POST['UserRecomendations'];
			if(!empty($_POST['nugget_id'])){
				$category = Category::model()->find('name=?',array($_POST['nugget_id']));
				$model->category_id = $category->id;
			}
			if(!empty($_POST['user_id']))
				$model->user_id = $_POST['user_id'];
			$model->recomender_id = Yii::app()->user->id;
			if(!empty($_POST['subcat_id']))
				$model->category_pk_id = $_POST['subcat_id'];
			$date = date('Y-m-d H:i:s');
			$model->create_date = $date;
			$model->modified_date = $date;
			// if it is ajax validation request
			$this->performAjaxValidation($model);
				
			if($model->save()){
				/*
				 * 
				 * Site Matrciks not needed for recomendation
				 * 
				$siteMatrics = new UsersSiteMatrics();
				$siteMatrics->visitor_user_id = Yii::app()->user->id;
				$siteMatrics->owner_user_id = $person->id;
				$siteMatrics->location = 'UKNOWN';
				$date = date('Y-m-d H:i:s');
				$siteMatrics->create_date = $date;
				$siteMatrics->activity_id = UsersActivity::model()->find('name=?',array('UserRecomendations'))->id;
				$siteMatrics->save();
				*/
			}
			else{
				//print_r($model);exit;
			}
				
		}
		else if(Yii::app()->user->id !== $person->id){
			
			
			$siteMatrics = new UsersSiteMatrics();
			$siteMatrics->visitor_user_id = Yii::app()->user->id;
			$siteMatrics->owner_user_id = $person->id;
			$visitor = Person::model()->findByPk(Yii::app()->user->id);
			$siteMatrics->location = 'UKNOWN';			
			$date = date('Y-m-d H:i:s');
			$siteMatrics->create_date = $date;
			$siteMatrics->activity_id = UsersActivity::model()->find('name=?',array('employee_profile'))->id;
			$siteMatrics->save();
		}

		$selected = null;
		if(isset($_GET['category'])){
			$selected = $_GET['category'];
		}
		//$profile = new EmployeeProfile($person,$selected);

		$model=new UserRecomendations;
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
			$model->user_id = $id;
		}
		else {$person = Person::model()->findByPk(Yii::app()->user->id);
		}
		$model->recomender_id = Yii::app()->user->id;
		
		
		$dataProvidersArray = array();
		
		
		$criteria = new CDbCriteria();
		$criteria->compare("user_id", $person->id);
		if(!empty($person->userAboutMe)){
		$dataProvidersArray['about'] = new CActiveDataProvider('UserAboutMe',array(
				'criteria'=>$criteria,
		));
		}
		
		if(!empty($person->userAcademics)){
		$dataProvidersArray['academic'] = new CActiveDataProvider('UserAcademic',array(
				'criteria'=>$criteria,
		));
		}
		if(!empty($person->userWorkExperiences)){
		$dataProvidersArray['workExperience'] = new CActiveDataProvider('UserWorkExperience',array(
				'criteria'=>$criteria,
		));
		}
		if(!empty($person->userVolunteerisms)){
		$dataProvidersArray['volunteerisms'] = new CActiveDataProvider('UserVolunteerism',array(
				'criteria'=>$criteria,
		));
		}
		
		if(!empty($person->userWritingLiterature)){
		$dataProvidersArray['literature'] = new CActiveDataProvider('UserWritingLiterature',array(
				'criteria'=>$criteria,
		));
		}
		if(!empty($person->culinaryArts)){
		$dataProvidersArray['culinary'] = new CActiveDataProvider('UserCulinaryArts',array(
				'criteria'=>$criteria,
		));
		}
		
		if(!empty($person->userDesignTechnology)){
		$dataProvidersArray['design'] = new CActiveDataProvider('UserDesign',array(
				'criteria'=>$criteria,
		));
		}
		
		if(!empty($person->scienceTechnologys)){
		$dataProvidersArray['userScienceTechnologys'] = new CActiveDataProvider('UserScienceTechnology',array(
				'criteria'=>$criteria,
		));
		}
		
		if(!empty($person->userMilitaryServices)){
		$dataProvidersArray['militaryServices'] = new CActiveDataProvider('UserMilitaryService',array(
				'criteria'=>$criteria,
		));
		}
		
		if(!empty($person->businessIntrepreneurships)){
		$dataProvidersArray['businessIntrepreneurships'] = new CActiveDataProvider('BusinessIntrepreneurship',array(
				'criteria'=>$criteria,
		));
		}
		if(!empty($person->travel)){
		$dataProvidersArray['travel'] = new CActiveDataProvider('UserTravel',array(
				'criteria'=>$criteria,
		));
		}
		
		if(!empty($person->userMusics)){
		$dataProvidersArray['userMusic'] = new CActiveDataProvider('UserMusic',array(
				'criteria'=>$criteria,
		));
		}
		
		
		$this->render('profile',array('person'=>$person,'id'=>$id,
				'dataProviders'=>$dataProvidersArray,
				));
		
		
		

	//	$this->render('maindiv',array('person'=>$person,'id'=>$id,'menu'=>$profile->getProfileDetailMenu(),'details'=>$profile->getSelectedProfileCategoryDetails(),'selected' =>$profile->getSelectedProfileCategorySelectName(),'title'=>$profile->getSelectedProfileCategoryTitle(),'progress'=>$profile->getProfileProgress()));
	

	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout='//layouts/column2';
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if($id != Yii::app()->user->id){
			$id = Yii::app()->user->id;
		}
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserDetails']))
		{
			$model->attributes=$_POST['UserDetails'];
			if($model->save()){
				//	$this->redirect(array('view','id'=>$model->user_id));
			}
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('user_id', $id);
		$model=UserDetails::model()->find($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-recomendations-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

	}

}
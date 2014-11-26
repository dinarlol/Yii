<?php

class NuggetsCreatorController extends Controller
{
	
        public $portlets = array();
	
/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}
	
	
	public $layout='//layouts/manageNugget';
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
		public function accessRules()
	{
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('writingliterature','designtechnology','fitness','performingarts','visualarts','culinaryarts','travel','businessintrepreneurships','create','update','index','view','workexperience','academics','awards','aboutme','music','militaryService','volunteerisms','story','scienceTechnologys'),
						'roles'=>array(AkimboNuggetManager::USER_ROLE),
				),
				
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'roles'=>array(AkimboNuggetManager::USER_ROLE),
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
	
    public function actionIndex()
    {
    	
    	if(isset($_REQUEST["hash"]))
    	{
    		$hash = $_REQUEST["hash"];
    	}else{
    		$hash = null;
    	}
       
       $this->render("maindiv",array(
           'menu'=>AkimboNuggetManager::getAllNuggets(),
       		'hash'=>$hash,
       		
        ),false,true);                     
      // $this->render('index');
        
    }
	
	public function actionWorkExperience(){
	
		$details = array();
		$person = Person::model()->findByPk(Yii::app()->user->id);
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
		$person = Person::model()->findByPk(Yii::app()->user->id);
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
		$person = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($person->userAwards)){
			$title = 'Awards';
			foreach ($person->userAwards as $detail){
				$details[] = array('title'=>$detail->award,'date'=>$detail->date,'description'=>$detail->description,'section'=>'Award');
			}
	
	
		}
	
		$this->renderPartial('ajax/view',array('details'=>$details,'selected'=>$selected,'title'=>$title), false, true);
	}






}
<?php

class NuggetsManagerController extends Controller
{
	
    public $user_id ;
    public $portlets = array();
	public $layout='//layouts/main';
    
    public function init()
    {
       $this->user_id = Yii::app()->user->getId();
    }
    
    private function loadNuggetsMenu()
    {
        /*$nuggetsArr = array(); 
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
        return $nuggetsArr; */
        return EmployeeProfile::getAllNuggets(); 
    }
    
    public function actionIndex()
    {
       /*$person = Person::model()->findByPk(Yii::app()->user->id);
            $profile = new EmployeeProfile($person);
       */  
       if(isset($_REQUEST["hash"]))
       {
           $hash = $_REQUEST["hash"];
       }else{
           $hash = null;
       }
           
       
       $this->render("maindiv",array(
           'id'=>$this->user_id,
           'hash'=>$hash,
           'menu'=>$this->loadNuggetsMenu(),
        ));                     
       //$this->render('index');
        
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	
	 
	
}
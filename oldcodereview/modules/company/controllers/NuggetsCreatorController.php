<?php

class NuggetsCreatorController extends Controller
{
	public $layout='//layouts/manageNugget';
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
	
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	
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
				
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
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
           'menu'=>AkimboNuggetManager::getAllCompanyNuggets(),
       		'hash'=>$hash,
       		
        ),false,true);                     
      // $this->render('index');
        
    }




}
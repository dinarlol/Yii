<?php
class VolunteerismsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $portlets = array();
        
        public $user_id;

	/**
	 * @return array action filters
	 */
        
        public function init()
        {
            $this->user_id = Yii::app()->user->getId(); 
        }
        
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','autoCompleteOrganization','autoCompleteCause','delete'),
				'roles'=>array(AkimboNuggetManager::USER_ROLE),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $this->layout = '//layout/blank';	
            $model=new UserVolunteerism;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                        
		if(isset($_POST['UserVolunteerism']))
		{
                    
                    $params = $_POST["UserVolunteerism"]; 
                    $params["user_id"] = $this->user_id; 
                    $params["create_date"] = date("Y-m-d H:i:s"); 
                    $params["modified_date"] = date('Y-m-d H:i:s');
                    
                    
                    $causeExist = NonProfitCauses::model()->exists("name = :name",array(":name"=>$params["cause"])); 
                    
                    if(!$causeExist)
                    {
                        $NonProfitCause = new NonProfitCauses(); 
                        $NonProfitCause->name = $params["cause"];
                        $NonProfitCause->save(); 
                        $NonprofitCauseId = $NonProfitCause->id; 
                       
                    }else{
                       $nonProfitData =  NonProfitCauses::model()->find("name = :name", array(":name"=>$params["cause"]));
                       $NonprofitCauseId = $nonProfitData->id;       
                                          
                    }
                    
                                        
                    $params["non_profit_causes_id"] = $NonprofitCauseId; 
                    
                    $organizationExist = NonprofitOrganizations::model()->exists("name = :name",array(":name"=>$params["organization"])); 
                    
                    if(!$organizationExist)
                    {
                        $NonProfitOrg = new NonprofitOrganizations();
                        $NonProfitOrg->name = $params["cause"];
                        $NonProfitOrg->website = "";
                        $NonProfitOrg->save(); 
                        $NonProfitOrgId = $NonProfitOrg->id; 
                        
                    }else{
                       $nonProfitOrgData = NonprofitOrganizations::model()->find("name = :name", array(":name"=>$params["organization"]));
                       $NonProfitOrgId = $nonProfitOrgData->id;       
                                    
                    }
                                       
                    $model->attributes = $params; 
                    $model->organization_id = $NonProfitOrgId;
                    $model->mycauses  = $params["mycauses"] ;
                    $error = CActiveForm::validate($model); 
                    
                    if(count(json_decode($error,true))>0)
                    {
                       echo $error;  
                    }else{
                        $model->save(); 	
                        echo "refresh form";             
                    }
                                                   
			/*if($model->save())
				$this->redirect(array('view','id'=>$model->id));*/
		}else{

                    $this->render('create',array(
                            'model'=>$model,
                            'user_id'=>$this->user_id,
                    ));
                }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            $this->layout = '//layout/blank';		
            $model=$this->loadModel($id);
                                       
              	// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                                
		if(isset($_POST['UserVolunteerism']))
		{
                        $error = CActiveForm::validate($model); 
                     
                        if(count(json_decode($error,true))>0)
                        {
                           echo $error;  
                        }else{
                            $model->attributes=$_POST['UserVolunteerism'];
                            if($model->save())
                            echo "refresh form";
                        }
                    
		}else{
                    $this->render('update',array(
                            'model'=>$model,
                    ),false,true);
                }

		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $this->layout = '//layout/blank';
            $dataProvider = new CActiveDataProvider('UserVolunteerism');
            
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserVolunteerism('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserVolunteerism']))
			$model->attributes=$_GET['UserVolunteerism'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
        
        public function actionAutoCompleteOrganization()
        {
            if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
            {
                $name = $_GET['q'];  
                $criteria = new CDbCriteria();
                $criteria->condition = "name like :sterm";
                $criteria->params = array(":sterm"=>"%$name%");
                $criteria->distinct = true;
                $organizationArray = NonprofitOrganizations::model()->findAll($criteria);
                
                $returnVal = '';
              
                foreach($organizationArray as $data)
                {
                     $returnVal .= $data->getAttribute('name')."\n";
                }
               echo $returnVal;
              
            }
        }
        
        public function actionAutoCompleteCause()
        {
            if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
            {
                $name = $_GET['q'];  
                $criteria = new CDbCriteria();
                $criteria->condition = "name like :sterm";
                $criteria->params = array(":sterm"=>"%$name%");
                $criteria->distinct = true;
                $organizationArray = NonProfitCauses::model()->findAll($criteria);
                
                $returnVal = '';
              
                foreach($organizationArray as $data)
                {
                     $returnVal .= $data->getAttribute('name')."\n";
                }
               echo $returnVal;
              
            }
        }
        
        
	public function loadModel($id)
	{
		//$model = UserVolunteerism::model()->findByPk($id);
            $model = UserVolunteerism::model()->findByPk($id);
                      
            if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-volunteerism-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

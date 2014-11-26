<?php
class MilitaryServicesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $user_id; 
        public $layout='//layouts/column2';
        public $portlets = array();
	
	public function init()
	{
		$this->user_id = Yii::app()->user->getId();
	 
	}
	
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
                    array('allow',  // allow all users to perform 'index' and 'view' actions
                            'actions'=>array('index','view'),
                            'users'=>array('*'),
                    ),
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
                            'actions'=>array('create','update','autoCompleteDevision','autoCompleteRank','delete'),
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
	
  	public function actionAutoCompleteDevision()
        {

            if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
            {
                $name = $_GET['q'];  
                $criteria = new CDbCriteria();
                $criteria->condition = "devision like :sterm";
                $criteria->params = array(":sterm"=>"%$name%");
                $criteria->distinct = true;
                $devisionArray = UserMilitaryService::model()->findAll($criteria);
                
                $returnVal = '';
              
                foreach($devisionArray as $data)
                {
                     $returnVal .= $data->getAttribute('devision')."\n";
                }
               echo $returnVal;
              
            }
            
        }
        public function actionAutoCompleteRank()
        {

            if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
            {
                $name = $_GET['q'];  
                $criteria = new CDbCriteria();
                $criteria->condition = "rank like :sterm";
                $criteria->params = array(":sterm"=>"%$name%");
                $criteria->distinct = true;
                $rankArray = UserMilitaryService::model()->findAll($criteria);
                
                $returnVal = '';
              
                foreach($rankArray as $data)
                {
                     $returnVal .= $data->getAttribute('rank')."\n";
                }
               echo $returnVal;
              
            }
            
        }
	
	public function actionCreate()
	{
            if(Yii::app()->request->isAjaxRequest)
                    $this->layout = '//layout/blank';	
            
            $model = new UserMilitaryService();
	    $model->create_date = date('Y-m-d H:i:s');
            $model->modified_date = date('Y-m-d H:i:s');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	           
		if(isset($_POST["UserMilitaryService"])){
                    $error = CActiveForm::validate($model); 
                     
                    if(count(json_decode($error,true))>0)
                    {
                       echo $error;  
                    }else{
                        $model->attributes=$_POST['UserMilitaryService'];
                        $model->save(); 	
                        echo "refresh form";             
                    }
                                                                                               
                }else{
                    $this->renderPartial('create',array(
                            'model'=>$model,
                            'user_id'=>$this->user_id,
                            
                     ),false,true);
                }

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
            if(Yii::app()->request->isAjaxRequest)
                    $this->layout = '//layout/blank';	
            
                $model=$this->loadModel($id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserMilitaryService']))
		{
			                      
                        $error = CActiveForm::validate($model); 
                     
                        if(count(json_decode($error,true))>0)
                        {
                           echo $error;  
                        }else{
                            $model->attributes=$_POST['UserMilitaryService'];
                            if($model->save())
                            echo "refresh form";
                        }
                        
				//$this->redirect(array('view','id'=>$model->id));
		}else{

                    $this->render('update',array(
                            'model'=>$model,
                            'user_id'=>$this->user_id,
                    ));
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
		if(Yii::app()->request->isAjaxRequest)
                    $this->layout = '//layout/blank';
            
                $criteria = new CDbCriteria(); 
                $criteria->compare("user_id", $this->user_id);

                $dataProvider=new CActiveDataProvider('UserMilitaryService',array(
                    'criteria'=>$criteria,
                ));
                     
               
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserMilitaryService('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserMilitaryService']))
			$model->attributes=$_GET['UserMilitaryService'];

		$this->render('admin',array(
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
		$model=UserMilitaryService::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-military-service-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

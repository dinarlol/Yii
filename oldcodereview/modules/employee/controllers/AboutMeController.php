<?php

class AboutMeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
	public $user_id; 
        public $portlets = array();

	public  function init()
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
				'actions'=>array('create','update','autoCompleteIndustry','removeIndustry','removeInterest','delete'),
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
                $model=new UserAboutMe;
                $Hobbies = new UserHobbies(); 
                $Industry= new UserLookingFor(); 
                          
                if(isset($_POST['UserAboutMe']))
		{
                        $model->attributes=$_POST['UserAboutMe'];
                        $model->save(); 	
                        echo "refresh form";             
                    
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
                        
		if(isset($_POST['UserAboutMe']))
		{
			
                       $model->attributes=$_POST['UserAboutMe'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
	                
                $this->render('update',array(
			'model'=>$model,
                        'user_id'=>$this->user_id,
                        'interestVal'=>$this->loadInterest(),
                        'userLookingForVal'=>$this->loadUserLookingFor(),
		));
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

            $criteria = new CDbCriteria(); 
            $criteria->compare("user_id", $this->user_id);
            
            $dataProvider= new CActiveDataProvider('UserAboutMe',array(
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
		$model=new UserAboutMe('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserAboutMe']))
                    $model->attributes=$_GET['UserAboutMe'];

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
		$model=UserAboutMe::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-about-me-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function loadInterest()
        {
            $Rows = UserHobbies::model()->findAll("user_id = '".$this->user_id."'"); 
            return $Rows;
      
        }
        
        public function actionAutoCompleteIndustry()
        {
            $industryArr = CHtml::listData(Industry::model()->findAll(array('select' => 'id, name')), 'id', 'name');
            $jsonOpen = "["; 
            $jsonClose = "]";
            $result = array();
            
            foreach($industryArr as $key=>$val)
            {
                
                $result[] = '{"name":"'.$val.'","id":"'.$key.'"}'; 
            }
            
            $data = implode(",", $result); 
            
            echo $jsonOpen.$data.$jsonClose; 
            
        }
        public function loadUserLookingFor()
        {
            $select = "SELECT lf.`industry_id`, ind.`name` FROM ak_user_looking_for lf 
                        INNER JOIN ak_industry ind ON (lf.`industry_id` = ind.`id`) WHERE lf.`user_id` = :user_id";
            
            $parameters = array(":user_id"=>$this->user_id);
            $cmd = Yii::app()->db->createCommand()
                                    ->select('lf.industry_id, ind.name')
                                    ->from("ak_user_looking_for lf")
                                    ->join("ak_industry ind", "lf.industry_id = ind.id")
                                    ->where('lf.user_id = 151');

            return $cmd->queryAll(); 
             
        }
        
        public function actionRemoveIndustry()
        {
            $id = $_REQUEST["industry_id"]; 
            if(!empty($id))
            {
                UserLookingFor::model()->deleteAll("industry_id = '$id' and user_id = '$this->user_id'"); 
                
            }
        }
        public function actionRemoveInterest()
        {
            $id = $_REQUEST["interest_id"]; 
            if(!empty($id))
            {
                UserHobbies::model()->deleteAll("id = '$id' and user_id = '$this->user_id'"); 
                
            }
        }
        
        
        
        
}

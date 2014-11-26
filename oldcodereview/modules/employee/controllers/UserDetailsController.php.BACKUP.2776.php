<?php

class UserDetailsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	
        public  $portlets = array();
        public  $user_id; 
        private $category_id;

	/**
	 * @return array action filters
	 */
        public function init()
        {
            $this->category_id = UserDetails::getCategoryId(); 
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
				'actions'=>array('create','update','delete','deleteImage'),
				'users'=>array('@'),
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
		$model=new UserDetails;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
             
		if(isset($_POST['UserDetails']))
		{
                    $error = CActiveForm::validate($model); 
                     
                    if(count(json_decode($error,true))>0)
                    {
                       echo $error;  
                    }else{
                        $model->attributes=$_POST['UserDetails'];
                        if($model->save()){
                            AkimboNuggetManager::uploadAllAttachments($this->category_id, $model->id);
                            $this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userDetails));
                            echo "refresh form";             
                        } 	
                        
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
           $model=$this->loadModel($id);

	   if(isset($_POST['UserDetails']))
           { 
			
                $model->attributes=$_POST['UserDetails'];
                $model->modified_date = AkimboNuggetManager::getSqlCurrentDate();

                //$this->performAjaxValidation($model);

                if($model->update()){
                        AkimboNuggetManager::uploadReplaceAttachments(AkimboNuggetManager::$content_type_photo, $this->category_id, $model->id);
                        $this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userDetails));

                }else{
                   echo 'here i m ';

                }


            }
		$this->render('update',array(
				'model'=>$model,
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
			$model = $this->loadModel($id)->delete();
                        
                        if(AkimboNuggetManager::deleteNuggetWithSingleUploadedAttachments($model))
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userDetails));
                        
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
        
        public function actionDeleteImage($id)
	{

		if(AkimboNuggetManager::deleteUploadedAttachments(AkimboNuggetManager::$content_type_photo, $id)){

				
			$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userDetails));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
             
            
            $employer = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($employer->userDetails)){
			
			$model = $employer->userDetails;
		}
		else{
		$model = new UserDetails();
		
		
		}
		$this->renderPartial('index',array(
				'model'=>$model,
		),false,true);
            
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserDetails('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserDetails']))
			$model->attributes=$_GET['UserDetails'];

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
		$model=UserDetails::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-details-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

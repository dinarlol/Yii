<?php

class TravelController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}
	/*
	 *
	*
	* setting category id from db and getting property name from AkimboNugeetManager
	*
	*
	*/
	private $category_id;
	public function init(){
		$this->category_id = Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_travel)))->id;
	
	
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
						'roles'=>array(AkimboNuggetManager::USER_ROLE),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','delete','delete','deleteImage'),
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
		$model=new UserTravel();
		if(isset($_POST['UserTravel']))
		{
			$model->user_id = Yii::app()->user->id;
			$model->attributes=$_POST['UserTravel'];
			$model->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$model->modified_date = $model->create_date;
			$this->performAjaxValidation($model);
			
			if($model->save()){
				AkimboNuggetManager::uploadAllAttachments($this->category_id, $model->id,$model->destination_id);
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_travel));
			}
			else{
			
				//print_r($model);
			}

		}
		else{
			$this->renderPartial('create',array(
					'model'=>$model,
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
		
		if(isset($_POST['UserTravel']))
		{
			$updatedmodel = new UserTravel();
			$updatedmodel = $model;
			$updatedmodel->attributes=$_POST['UserTravel'];
			$this->performAjaxValidation($updatedmodel);
		    $model->user_id = Yii::app()->user->id;
			$model->modified_date = AkimboNuggetManager::getSqlCurrentDate();
				
			if($model->update()){
				AkimboNuggetManager::uploadAllAttachments($this->category_id, $model->id ,$model->destination_id);
			
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_travel));
			}
			

		
	}
	$this->renderPartial('update',array(
			'model'=>$model,
	),false,true);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
			if(Yii::app()->user->id == $model->user_id){
			
			if(AkimboNuggetManager::deleteNuggetWithUploadedAttachments($model))
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_travel));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	
	/**
	 * Deletes a particular Image Attachements.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteImage($id)
	{
	
		if(AkimboNuggetManager::deleteUploadedAttachments(AkimboNuggetManager::$content_type_photo, $id)){
	
	
			$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_travel));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new UserTravel();
		$model->user_id = Yii::app()->user->id;
		$this->renderPartial('index',array(
				'model'=>$model,
		),false,true);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserTravel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserTravel']))
			$model->attributes=$_GET['UserTravel'];

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
		$model=UserTravel::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='travel-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

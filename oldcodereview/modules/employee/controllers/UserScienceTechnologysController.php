<?php

class UserScienceTechnologysController extends Controller
{
	
	
	private $category_id;
	public function init(){
		$this->category_id = Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_scienceTechnologys)))->id;
	
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
				'roles'=>array(AkimboNuggetManager::USER_ROLE),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'roles'=>array(AkimboNuggetManager::USER_ROLE),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('deleteDoc','delete'),
				'roles'=>array(AkimboNuggetManager::USER_ROLE),
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
		$model=new UserScienceTechnology;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserScienceTechnology']))
		{
			$model->attributes=$_POST['UserScienceTechnology'];
			$model->user_id = Yii::app()->user->id;
			$model->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$model->modified_date = $model->create_date;
			$this->performAjaxValidation($model);
			if($model->save())
				AkimboNuggetManager::uploadAllAttachments($this->category_id, $model->id);
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_scienceTechnologys));
		}

		$this->renderPartial('create',array(
					'model'=>$model,
			),false,true);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserScienceTechnology']))
		{
			$model->attributes=$_POST['UserScienceTechnology'];
			$model->user_id = Yii::app()->user->id;
			$model->modified_date = AkimboNuggetManager::getSqlCurrentDate();
			$this->performAjaxValidation($model);
			if($model->update()){
				AkimboNuggetManager::uploadAllAttachments($this->category_id, $model->id);
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_scienceTechnologys));
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
		$model = UserScienceTechnology::model()->findByPk($id);
		if(Yii::app()->user->id == $model->user_id)
		{
			if(AkimboNuggetManager::deleteNuggetWithUploadedAttachments($model))
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_scienceTechnologys));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
	 * Deletes a particular Image Attachements.
	 * If deletion is successful, the browser will be redirected to the 'main' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteDoc($id)
	{
	
		if(AkimboNuggetManager::deleteUploadedAttachments(AkimboNuggetManager::$content_type_document, $id)){	
	
			$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_scienceTechnologys));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new UserScienceTechnology();
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
		$model=new UserScienceTechnology('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserScienceTechnology']))
			$model->attributes=$_GET['UserScienceTechnology'];

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
		$model=UserScienceTechnology::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-science-technology-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

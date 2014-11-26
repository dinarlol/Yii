<?php

class CompanyAboutMeController extends Controller
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
		$this->category_id = CompanyDetail::getCategoryId();

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
						'roles'=>array(AkimboNuggetManager::COMPANY_ROLE),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','delete','deleteImage'),
						'roles'=>array(AkimboNuggetManager::COMPANY_ROLE),
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
		$employer = Person::model()->findByPk(Yii::app()->user->id);
		$model=new CompanyDetail();
		$model->company = $employer->companys;
		$model->company_id = $employer->companys->id;
		
		if(isset($_POST['CompanyDetail']))
		{
			
			$model->company->attributes=$_POST['Company'];
			$model->attributes=$_POST['CompanyDetail'];
			$model->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$model->modified_date = $model->create_date;
			$this->performAjaxValidation(array($model->company,$model));
			if($model->company->save()){
			if($model->save()){
				AkimboNuggetManager::uploadAllAttachments($this->category_id, $model->id);
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_companyAboutMe));
			}
			else{

				//print_r($model);
			}
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

		if(isset($_POST['Company']))
		{
			$model->company->attributes=$_POST['Company'];
			$model->attributes=$_POST['CompanyDetail'];
			$model->modified_date = AkimboNuggetManager::getSqlCurrentDate();
			
			$this->performAjaxValidation(array($model->company,$model));
			
			
			if($model->company->update()){
				if($model->update()){
					AkimboNuggetManager::uploadReplaceAttachments(AkimboNuggetManager::$content_type_photo, $this->category_id, $model->id);
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_companyAboutMe));
			}
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
		$employer = Person::model()->findByPk(Yii::app()->user->id);
		if($employer->companys->id == $model->company_id){				
				
			if(AkimboNuggetManager::deleteNuggetWithSingleUploadedAttachments($model))
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_companyAboutMe));
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

				
			$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_companyAboutMe));
		}
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		$employer = Person::model()->findByPk(Yii::app()->user->id);
		if(!empty($employer->companys->companyDetails)){
			
			$model = $employer->companys->companyDetails;
		}
		else{
		$model = new CompanyDetail();
		$model->company_id = $employer->companys->id;
		
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
		$model=new UserCulinaryArts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserCulinaryArts']))
			$model->attributes=$_GET['UserCulinaryArts'];

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
		$model=CompanyDetail::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-detail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

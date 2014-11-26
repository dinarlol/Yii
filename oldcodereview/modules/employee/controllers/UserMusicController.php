<?php

class UserMusicController extends Controller
{


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}


	private $category_id;
	public function init(){
		$this->category_id = Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_userMusics)))->id;

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
						'actions'=>array('index','view','delete','deleteVideo'),
						'roles'=>array(AkimboNuggetManager::USER_ROLE),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'roles'=>array(AkimboNuggetManager::USER_ROLE),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin'),
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
		$model=new UserMusic;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserMusic']))
		{
			$model->user_id = Yii::app()->user->id;
			$model->attributes=$_POST['UserMusic'];
			$model->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$model->modified_date = $model->create_date;
			//print_r($model);exit;
			$this->performAjaxValidation($model);
			if(isset($_POST['UserMusicDetail'])){
				$userMusicDetail = new UserMusicDetail();
				$userMusicDetail->attributes = $_POST['UserMusicDetail'];
				$userMusicDetail->create_date = AkimboNuggetManager::getSqlCurrentDate();
				$userMusicDetail->modified_date = $userMusicDetail->create_date;

				$this->performAjaxValidation($userMusicDetail);
			}
				
			if($model->save()){
				$userMusicDetail->fk_id = $model->id;
				if($userMusicDetail->save()){
					if(isset($_POST['VideoUploader'])){
						$upload_add = new VideoUploader();
						$upload_add->create_date = AkimboNuggetManager::getSqlCurrentDate();
						$upload_add->modified_date = AkimboNuggetManager::getSqlCurrentDate();
						$upload_add->link = $_POST['VideoUploader']['link'];
						$upload_add->user_id = Yii::app()->user->id;
						$upload_add->category_id = $this->category_id;
						$upload_add->category_pk_id = $userMusicDetail->id;
						//$this->performAjaxValidation($upload_add);
						if($upload_add->save()){


						}
					}
					$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userMusics));
				}
				else{

					print_r($userMusicDetail);exit;
				}
			}
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

		if(isset($_POST['UserMusic']))
		{
			$model->user_id = Yii::app()->user->id;
			$model->attributes=$_POST['UserMusic'];
			$model->modified_date = AkimboNuggetManager::getSqlCurrentDate();
				
			//print_r($model);exit;
			$this->performAjaxValidation($model);

				
			if($model->update()){
				if(isset($_POST['UserMusicDetail'])){
					$userMusicDetail = new UserMusicDetail();
					$userMusicDetail->attributes = $_POST['UserMusicDetail'];
					$userMusicDetail->create_date = AkimboNuggetManager::getSqlCurrentDate();
					$userMusicDetail->modified_date = $userMusicDetail->create_date;
					$userMusicDetail->fk_id = $model->id;
					$this->performAjaxValidation($userMusicDetail);
					if($userMusicDetail->save()){
						if(isset($_POST['VideoUploader'])){
							$upload_add = VideoUploader::model()->findByPk($_POST['VideoUploader']);
							if(empty($upload_add)){
								$upload_add = new VideoUploader();
								$upload_add->create_date = AkimboNuggetManager::getSqlCurrentDate();
							}
							$upload_add->modified_date = AkimboNuggetManager::getSqlCurrentDate();
							$upload_add->link = $_POST['VideoUploader']['link'];
							$upload_add->user_id = Yii::app()->user->id;
							$upload_add->category_id = $this->category_id;
							$upload_add->category_pk_id = $userMusicDetail->id;
								
								
							//$this->performAjaxValidation($upload_add);
							if($upload_add->save()){

							}
							else{
								print_r($upload_add);exit;
							}
						}
						else{print_r($_POST['video_link']);exit;
						}
					}
					else{

						print_r($userMusicDetail);exit;
					}
				}
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userMusics));

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
		$model=UserMusic::model()->findByPk($id);
		if(!empty($model->userMusicDetails)){
			foreach ($model->userMusicDetails as $detail){
				$detail->delete();
			}

		}

		if(AkimboNuggetManager::deleteNuggetWithUploadedAttachments($model)){

			$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userMusics));
		}
	}



	/**
	 * Deletes a particular Video Attachements.
	 * If deletion is successful, the browser will be redirected to the 'main' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteVideo($id)
	{

		if(VideoUploader::model()->findByPk($attachment_id)->delete()){


			$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userMusics));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

		$model = new UserMusic();
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
		$model=new UserMusic('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserMusic']))
			$model->attributes=$_GET['UserMusic'];

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
		$model=UserMusic::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-music-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

<?php

class JobRecomendationsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','view','manage'),
						'roles'=>array(AkimboNuggetManager::COMPANY_ROLE),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','nuggetsfield'),
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


	/*
	 *
	*
	*
	*/

	public function actionNuggetsfield()
	{
		//please enter current controller name because yii send multi dim array

		$nugget = strtolower($_POST['nugget_id']);
		echo $nugget;
		$data = AkimboNuggetManager::getNuggetsBox($nugget,$_POST['JobRecommendations']['user_id']);
		//$data=CHtml::listData($data,'id','school');
		//print_r($data);

		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value'=>$value),CHtml::encode($name),true);
		}
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
		$model=new JobRecommendations;
		if(isset($_GET['id'])){
			$person = Person::model()->findByPk($_GET['id']);
			$id = $_GET['id'];
			$model->user_id = $id;
		}
		else {$person = Person::model()->findByPk(Yii::app()->user->id);
		}
		$model->recomender_id = Yii::app()->user->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JobRecommendations']))
		{
			$model->attributes=$_POST['JobRecommendations'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$profile = new EmployeeProfile($person);

		$this->render('create',array(
				'model'=>$model,
				'nuggets'=>$profile->getFilledProfileNuggets(),
		));
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

		if(isset($_POST['JobRecommendations']))
		{
			$model->attributes=$_POST['JobRecommendations'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}
	
	
	
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionManage($category_id)
	{
		$model=$this->loadModelByCategory($category_id);
		
		$user=Person::model()->findByPk(Yii::app()->user->id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['JobRecommendations']))
		{
			
			foreach ($_POST['JobRecommendations']['id'] as $id){
			$model = $this->loadModel($id);
			if(isset($_POST[$id])){
				if($model->show !== 1){
					$model->show = 1;
				}
			}
			else if ($model->show !== 0){
				$model->show = 0;
			}
			
			if($model->save()){
				echo $model->comments." save <br>";
				
			}
			}
			$this->redirect(array('index'));
			//$this->redirect(array('manage','category_id'=>$model->category_id));
		}
		$manager = new AkimboNuggetManager($user);
	  $manager->createRecomendationStatsByCategoryId($category_id);
	  $this->render('manage_update',array(
				'models'=>$model,
				'stats' =>$manager->getRecomendationStats(),
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

		$jobs=PostJob::model()->findAll('employer_id=?',array(Yii::app()->user->id));
		$jobsId = array();
		foreach ($jobs as $job){
			$jobsId[] = $job->id;
		}
		
		$criteria = new CDbCriteria();
		$criteria->addInCondition('job_id', $jobsId);
		
		$jobsRecommendation = JobRecommendations::model()->findAll($criteria);
		
		$this->render('view',array(
				'models'=>$jobsRecommendation,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new JobRecommendations('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['JobRecommendations']))
			$model->attributes=$_GET['JobRecommendations'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModelByCategory($category_id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('user_id', Yii::app()->user->id);
		$criteria->compare("category_id", $category_id);
		//$model=JobRecommendations::model()->findAll(array('user_ids=?','category_id=?'),array(Yii::app()->user->id,$category_id));
		$model=JobRecommendations::model()->findAll($criteria);
		//print_r($model);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=JobRecommendations::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-recomendations-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

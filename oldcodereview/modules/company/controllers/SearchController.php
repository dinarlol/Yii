<?php

class SearchController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','completeprofile','search','searchemployee'),
				'roles'=>array(AkimboNuggetManager::COMPANY_ROLE),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CompanyDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CompanyDetail']))
		{
			$model->attributes=$_POST['CompanyDetail'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	

	
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if($id != Yii::app()->user->id){
			$id = Yii::app()->user->id;
		}
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(!isset($model->companyDetails)){
			$model->companyDetails = new CompanyDetail;
		
		}

		if(isset($_POST['Company']) && isset($_POST['CompanyDetail']))
		{
			$companyDetails = new CompanyDetail;
			$model->attributes=$_POST['Company'];
			$model->companyDetails->attributes=$_POST['CompanyDetail'];
			$model->companyDetails->company_id = $model->id;
			//print_r($companyDetails);exit;
			
			$transaction=Yii::app()->db->beginTransaction();
			try {
			//if($companyDetails->validate()){
				if($model->save()){
					
					
				if($model->companyDetails->save()){
					
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->user_id));
			}
			}
			
				//$this->redirect(array('view','id'=>$model->user_id));
		
			}
			catch(Exception $e) { // an exception is raised if a query fails
				//something was really wrong - exception!
				$transaction->rollBack();
				print_r($e);exit;
			
				//you should do sth with this exception (at least log it or show on page)
				Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
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
		
		
		/**
		 * Manages all models.
		 */
		
		$model = new CompanyDetail();
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['UserDetails']))
				$model->attributes=$_GET['UserDetails'];
		
			
		
		
		$company = Employer::model()->findByPk(Yii::app()->user->id);
		$companyprofile = new CompanyProfile($company);
		//print_r($companyprofile);
		$this->layout='//layouts/user';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_left_start';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_left_center_start';
		$this->render('index',array(
					'model'=>$model,
			));
		$this->layout='//layouts/content_company_left_center_finish';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_left_finish';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_right_start';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_right_finish';
		$this->render('home/blank');
		$this->layout='//layouts/footer';
		$this->render('home/blank');
	}

	
	public function actionSearch()
	{
	
	
		/**
		 * Manages all models.
		 */
	
		$model = new Company();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Company']))
			$model->attributes=$_GET['Company'];
	
	
	
	
		$company = Employer::model()->findByPk(Yii::app()->user->id);
		$companyprofile = new CompanyProfile($company);
		//print_r($companyprofile);
		$this->layout='//layouts/user';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_left_start';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_left_center_start';
		$this->render('company_search',array(
				'model'=>$model,
		));
		$this->layout='//layouts/content_company_left_center_finish';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_left_finish';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_right_start';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_right_finish';
		$this->render('home/blank');
		$this->layout='//layouts/footer';
		$this->render('home/blank');
	}
	
	
	
	public function actionSearchEmployee()
	{
	
	
		/**
		 * Manages all models.
		 */
	
		$model = new Person();
		$model->unsetAttributes();
		if(isset($_POST['keyword']))
			$model->keyword = $_POST['keyword'];
		else if (isset($_REQUEST['Person']))
			$model->keyword = $_REQUEST['Person']['keyword'];
		$this->layout='//layouts/user';
		$this->render('home/blank');
		$this->layout='//layouts/blank';
		$this->render('home/blank');
		$this->layout='//layouts/content_search_left_center_start';
		$this->render('search',array(
				'model'=>$model,
		));
		$this->layout='//layouts/content_search_left_center_finish';
		$this->render('home/blank');
		//$this->layout='//layouts/content_company_left_finish';
		//$this->render('home/blank');
		$this->layout='//layouts/content_company_right_start';
		$this->render('home/blank');
		$this->layout='//layouts/content_company_right_finish';
		$this->render('home/blank');
		$this->layout='//layouts/footer';
		$this->render('home/blank');
	}
	
	
	
	
	public function actionView(){
		

	$this->redirect(array('/employee/profile/viewprofile', 'id' => $_GET['id']));
	
	}
	
	
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CompanyDetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CompanyDetail']))
			$model->attributes=$_GET['CompanyDetail'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadCompanyLookingToHireModel($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('company_id', $id);
		$model=CompanyLookingToHire::model()->find($criteria);
		
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
		$criteria = new CDbCriteria();
		$criteria->compare('user_id', $id);
		$model=Company::model()->find($criteria);
	
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-looking-to-hire-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

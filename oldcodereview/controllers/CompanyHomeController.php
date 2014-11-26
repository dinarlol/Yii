<?php

class CompanyHomeController extends Controller
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
				'actions'=>array('view','create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','update'),
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
		$person = new Person;
		$model=new Company;
		$companydetailmodel = new Company;
		
		$criteria = new CDbCriteria();
		$criteria->compare('name', $model->companyRole);
		$rolemodel = Roles::model()->find($criteria);
		
		$criteria1 = new CDbCriteria();
		$criteria1->compare('name', $model->userGroup);
		$groupmodel = Group::model()->find($criteria1);
		
		$industrydetail = Industry::model()->findAll();
		$rangedetail = CompanyRanges::model()->findAll();
		$reqparams = array('range'=>$rangedetail,'industry'=>$industrydetail);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

	if(isset($_POST['Person']))
		{
			$transaction=Yii::app()->db->beginTransaction();
			$validationemail = new EMailValidation();
			$validationemail->email = $_POST['Person']['email'];
			$validationemail->password = md5(md5($_POST['Person']['password']).Yii::app()->params["@k!MbO"]);
			$validationemail->ip = $_SERVER['REMOTE_ADDR'];
			$validationemail->time = time();
			$validationemail->session = md5($validationemail->time.rand(100000,999999));
			$validationemail->sessionLink = $this->createAbsoluteUrl('user/validate', array('code'=>$validationemail->session));
			try {
				$person->attributes = $_POST['Person'];
				$pass = md5(md5($person->password).Yii::app()->params["@k!MbO"]);
				$repeatpass = md5(md5($person->repeat_password).Yii::app()->params["@k!MbO"]);
				$person->repeat_password = $repeatpass;
				$person->password = $pass;
				$person->verifyCode = $validationemail->session;
				$person->validationEmailLink = $validationemail->sessionLink;
				$person->group_id = $groupmodel->id;
				$person->role_id = $rolemodel->id;
				$person->status = 4;
				$person->fullname = $_POST['Company']['name'];
				if ($person->save()) {
					$companydetailmodel->attributes = $_POST['Company'];
					$companydetailmodel->user_id = $person->id;
					if ($companydetailmodel->save()) {
					$validationemail->userID = $model->id;
						if($validationemail->save())
						{
							// save user registration
							
							$transaction->commit();
							$this->render('register',array('form'=>$validationemail));
							return;
							
							
						}
						else{
							$transaction->rollBack();
							
						}
						
					}
				}
				else{
				//something went wrong...
				$transaction->rollBack();
				}
				
			}
			catch(Exception $e) { // an exception is raised if a query fails
				//something was really wrong - exception!
				
				
				
				//$transaction->rollBack();
			
				//you should do sth with this exception (at least log it or show on page)
				Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
			
			}
			}

		$this->render('create',array(
			'model'=>$model,'loginmodel'=>$person,'reqparams'=>$reqparams
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

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		/*
		 * $dataProvider=new CActiveDataProvider('Post', array(
    'criteria'=>array(
        'condition'=>'status=1',
        'order'=>'create_time DESC',
        'with'=>array('author'),
    ),
    'pagination'=>array(
        'pageSize'=>20,
    ),
));
		 * 
		 */
		
		$this->layout='//layouts/company';
		$dataProvider=new CActiveDataProvider('Company', array(
				'criteria'=>array(
						'condition'=>'user_id='.Yii::app()->user->id,
				
				),
		));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		$this->layout='//layouts/maindiv1';
		$this->render('home/progress');
		$this->render('home/recommendation');
		$this->render('home/activity');
		$this->render('home/sitematrix');
		$this->layout='//layouts/footer';
		$this->render('home/blank');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Company('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Company']))
			$model->attributes=$_GET['Company'];

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
		$model=Company::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

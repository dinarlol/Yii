<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $portlets = array('RecentRecomendation'=>array(),'RecentSiteMatrics'=>array());

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
				'actions'=>array('update','index','view','validate','forgotPassword','validatereset','resetpassword'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('validate','validateforgotpassword'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
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
		//$model = $this->loadModel($id);
		//$userdetail = $model->userDetails;
		//print_r($userdetail);exit;
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
		$model=new UserRegisterar;
		$userdetailmodel = new UserDetails();
		$companydetailmodel = new Company;
		
		$criteria = new CDbCriteria();
		$criteria->compare('name', $model->userRole);
		$rolemodel = Roles::model()->find($criteria);
		
		$criteria1 = new CDbCriteria();
		$criteria1->compare('name', $model->userGroup);
		$groupmodel = Group::model()->find($criteria1);
		
		
		$industrydetail = Industry::model()->findAll();
		$rangedetail = CompanyRanges::model()->findAll();
		
		$reqparams = array('range'=>$rangedetail,'industry'=>$industrydetail);
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset($_POST['UserRegisterar'])) {
			$validationemail = new EMailValidation();
			$validationemail->email = $_POST['UserRegisterar']['email'];
			$validationemail->password = $model->password;
			$validationemail->ip = $_SERVER['REMOTE_ADDR'];
			$validationemail->time = time();
			$validationemail->session = md5($validationemail->time.rand(100000,999999));
			$validationemail->sessionLink = $this->createAbsoluteUrl('user/validate', array('code'=>$validationemail->session));
			$transaction=Yii::app()->db->beginTransaction();
			try {
				$model->attributes = $_POST['UserRegisterar'];
				$model->verifyCode = $validationemail->session;
				$model->validationEmailLink = $validationemail->sessionLink;
				$model->fullname = $_POST['UserDetails']['first_name'].' '.$_POST['UserDetails']['last_name'];
				if ($model->save()) {
					$userdetailmodel->attributes = $_POST['UserDetails'];
					$userdetailmodel->user_id = $model->id;
					if ($userdetailmodel->save()) {
						
						$validationemail->userID = $model->id;
						if($validationemail->save())
						{
							// save user registration
							
							$transaction->commit();
							
							
							
						}
						else{
							$transaction->rollBack();
							
						}
						//$transaction->commit();
						$this->render('register',array('form'=>$validationemail));
						return;
						//$this->redirect(array('view', 'id' => $model->id));
					}
				}
				//something went wrong...
				$transaction->rollBack();
			}
			catch(Exception $e) { // an exception is raised if a query fails
				//something was really wrong - exception!
				$transaction->rollBack();
		
				//you should do sth with this exception (at least log it or show on page)
				Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
			}
		}
		
		$this->render('create',array('model'=>$model,'loginmodel'=>$model,'userdetailmodel'=>$userdetailmodel,'reqparams'=>$reqparams,'companydetailmodel'=>$companydetailmodel));
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

		if(isset($_POST['UserRegisterar']))
		{
			$model->attributes=$_POST['UserRegisterar'];
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

	
	public function actionValidate()
	{
		$code = $_GET['code'];
	
		$validate = new EMailValidation;
		// find hash
		$validate = EMailValidation::model()->find('session=?', array($code));
		
	
		if($validate == NULL)
		{
			$this->redirect(array('site/login'));
			/*
			$validate = new EMailValidation;
			$validate->sessionValid = "Not Valid";
			$this->render('validate',array('validate'=>$validate));
			*/
		}
		else
		{
			$user = UserRegisterar::model()->find('email=?', array($validate->email));
			
			// Define how long until the session expires
			// 1 is the number of days.
			$valid = 3600*24*1;
			$time = time();
			$timeElasped = $time - $valid;
	
			if($validate->time < $timeElasped)
			{
				// Took to long to confirm registration
				$validate->sessionValid = "Not Valid";
				// Delete the record
				$validate->delete();
			}
			else
			{
				// Session is valid, transfer data to user table
				$validate->sessionValid = "Valid";
				// Set all the column values
				//$user->ip = $_SERVER['REMOTE_ADDR'];
				$user->status =  $user->activestatus;
				//print_r($user);exit;
				if($user->validate()){
					
					try{
					if($user->update())
					{
						// Delete the record
						$validate->delete();
						$validate->emailed = $user->emailed;
						$this->render('validate',array('validate'=>$validate));
						return;
					
					}
					else{
					
						//print_r($user->getErrors());//exit;
					}	
					}catch(Exception $e) {
						
						$this->redirect(array('site/login'));
						
						//print_r($e);exit;
					}
				}
				else{
					//echo 'validation error';
					//print_r($user);exit;
				}
				
	
				if($user->emailed == "Sent")
				{
					$this->redirect(array('site/login'));
				}
				
			} // close inner else statement
		} // close outer else statement
	}
	
	
	public function actionValidateForgotPassword()
	{
		$this->layout='//layouts/main_raw';
		if(!isset($_GET['code'])){
			$this->redirect(YII::app()->baseUrl);
		}
		$code = $_GET['code'];
		$validate = ValidateForgotPassword::model()->find('session=?', array($code));
		
		if($validate !== NULL){
			$form = UserRegisterar::model()->find('email=?', array($validate->email));
			// Define how long until the session expires
			// 1 is the number of days.
			$valid = 3600*24*1;
			$time = time();
			$timeElasped = $time - $valid;
			
			if($validate->time < $timeElasped)
			{
				// Took to long to confirm registration
				$validate->sessionValid = "Not Valid";
				// Delete the record
				$validate->delete();
			}
			else
			{
				$validate->sessionValid = "Valid";
				
				
			} // close inner else statement
			
			
			
		if(!isset($_POST['UpdatePassword']['password'])){
			
			$validate->sessionValid = "Reset Password";
			$form = UpdatePassword::model()->find('email=?',array($validate->email));
			$this->render('validate',array('validate'=>$validate,'form'=>$form));
			return;
			
		}
		else{
			
			$form = UpdatePassword::model()->find('email=?',array($validate->email));
			$form->password = $_POST['UpdatePassword']['password'];
			$form->repeat_password = $_POST['UpdatePassword']['repeat_password'];
			$form->ip = $_SERVER['REMOTE_ADDR'];
			
			if($form->validate()){
				if($form->update()){
					$validate->delete();
					$validate->sessionValid = $form->emailed;
					$this->render('validate',array('validate'=>$validate,'form'=>$form));
					return;
					
				}
			}
			else{
				$validate->sessionValid = "Reset Password";
				$this->render('validate',array('validate'=>$validate,'form'=>$form));
				return;
			}
			
		}
		}
		else{
			$validate = new ValidateForgotPassword;
			$validate->sessionValid = "Not Valid";
			$this->render('validate',array('validate'=>$validate));
			return;
		}
	
		
	
		
	}
	
	
	public function actionForgotPassword()
	{
		$form=new UserRegisterar;
		$form->scenario='stage1';
		
	
		// collect user input data
		if(isset($_POST['UserRegisterar']['email']))
		{
			if($_POST['UserRegisterar']['email'] == $_POST['UserRegisterar']['repeat_email']){
			$form=UserRegisterar::model()->find('email=?', array($_POST['UserRegisterar']['email']));;
			
			// validate user input and redirect
			if($form != null)
			{
					$validationemail = new ValidateForgotPassword();
					$validationemail->email = $form->email;
					$validationemail->ip = $_SERVER['REMOTE_ADDR'];
					$validationemail->time = time();
					$validationemail->session = md5($validationemail->time.rand(100000,999999));
					$validationemail->sessionLink = $this->createAbsoluteUrl('user/validateforgotpassword', array('code'=>$validationemail->session));
					$validationemail->validationEmailLink = $validationemail->sessionLink;
					$validationemail->emailed = $form->emailed;
					$validationemail->userID = $form->id;
					
					if($validationemail->save())
					{
						$form->stage = $validationemail->emailed;
					}
					
				else
				{
					$form->stage = "Email Not sent please contact support";
				}
			}
			else
			{
				$form->stage = "Email Not Found";
			}
		
		}
		else{
			$form->stage = "Email Not Match";
		}
		}
		
		else
		{
			$form->stage = "Find User";
		}
		// display the registration form
		$this->render('forgotPassword',array('form'=>$form));
	}
	
	public function actionValidateReset()
	{
		$form=new ForgotPassword;
		$query=new ForgotPassword;
		$form->scenario='stage2';
	
		$email = $_GET['email'];
		$form->email = $email;
	
		// collect user input data
		if(isset($_POST['ForgotPassword']))
		{
			$form->attributes=$_POST['ForgotPassword']; // set all attributes with post values
	
			// validate user input and redirect
			if($form->validate())
			{
				$query = ForgotPassword::model()->find('email=?', array($form->email));
				if($query != NULL)
				{
					$url = $this->createUrl('user/resetpassword', array('row'=>$query->id));
					$this->redirect($url);
				}
				else
				{
					$form->stage = "Answer Invalid";
				}
			}
			else
			{
				$form->stage = "Answer email";
			}
		}
		else
		{
			$form->stage = "Answer email";
		}
		// display the registration form
		$this->render('forgotPassword',array('form'=>$form));
	}
	
	public function actionResetPassword()
	{
		$form=new ForgotPassword;
		$form->scenario='stage3';
	
		$row = $_GET['row'];
		$form->id = $row;
	
		// collect user input data
		if(isset($_POST['ForgotPassword']))
		{
			$form->attributes=$_POST['ForgotPassword']; // set all attributes with post values
	
			if($form->validate())
			{
				$query = ForgotPassword::model()->find('id=?', array($form->id));
				// This assigns the user ip, the current time
				$query->ip = $_SERVER['REMOTE_ADDR'];
				$query->time = time();
				$query->password = $form->password;
				$query->password2 = $form->password2;
				//$query->status = 4;
				
				$validationemail = new ValidateResetPass();
				$validationemail->email = $query->email;
				$validationemail->ip = $_SERVER['REMOTE_ADDR'];
				$validationemail->time = time();
				$validationemail->session = md5($validationemail->time.rand(100000,999999));
				$validationemail->sessionLink = $this->createAbsoluteUrl('user/validate', array('code'=>$validationemail->session));
				$validationemail->emailed = $query->emailed;
				$transaction=Yii::app()->db->beginTransaction();
				$validationemail->userID = $query->id;
				$query->verifyCode = $validationemail->session;
				$query->validationEmailLink = $validationemail->sessionLink;
				
	
				if($query->validate())
				{
					// Save the new password
					
					$query->update();
					if($validationemail->save())
					{
						// save user registration
					
						$form->emailed = $query->emailed;
						$transaction->commit();				
					
					
					}
					//print_r($query);exit;
					
				}
			}
			else{
				
				
			}
		}
		if($form->emailed == "Sent")
		{
	
			$this->render('forgotPassword',array('form'=>$form));
		}
		else
		{
			$form->stage = "Reset Password";
			// display the password reset form
			$this->render('forgotPassword',array('form'=>$form));
		}
	}
	
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		$recomendations = new UserRecomendations();
		$recomendations->user_id = Yii::app()->user->id;
		$person = $recomendations->user;
		$profile = new EmployeeProfile($person);
		//$this->layout='//layouts/main';
		$this->render('home/progress',array('progress'=>$profile->getProfileProgress()));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Person('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Person']))
			$model->attributes=$_GET['Person'];

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
		$model=UserRegisterar::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='person-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
	public $layout='//layouts/login';
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page'=>array(
						'class'=>'CViewAction',
				),
		);
	}


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
			
		if(!Yii::app()->user->isGuest){
			$person = Person::model()->find('id=?',array(Yii::app()->user->id));


			if(strtoupper($person->role->name) == $person->companyRole){
				$this->redirect('?r=company/details');
			}
			else if(strtoupper($person->role->name) == $person->userRole){

					$this->redirect('?r=user');
					
			}
		}
			
		$model=new LoginForm;
		$userloginform = new UserRegisterar();
		$companyloginform = new CompanyRegisterar();

		$userloginform->userDetails = new UserDetails();
		$companyloginform->company = new Company();
		//$userdetailmodel = new UserDetails();
		//$companydetailmodel = new Company();
		$industrydetail = Industry::model()->findAll();;
		$rangedetail = CompanyRanges::model()->findAll();;

		$reqparams = array('range'=>$rangedetail,'industry'=>$industrydetail);

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// print_r($reqparams['industry']);exit;
		// display the login form
		$this->render('index',array('model'=>$model,'userloginform'=>$userloginform,'companyloginform'=>$companyloginform,'reqparams'=>$reqparams));


	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{

		
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			$person=Person::model()->find('LOWER(email)=?',array(strtolower($model->username)));
			if(!empty($person->status)){
				if($person->status !== $person->activestatus){
					$this->render('email_validation_required',array('form'=>$person));
				}
			}
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				//$this->redirect(Yii::app()->user->returnUrl);
				if(strtoupper($person->role->name) == $person->companyRole){
					$this->redirect('?r=company');
				}
				else if(strtoupper($person->role->name) == $person->userRole){
					$this->redirect('?r=user');
				}else{
					print_r($person->role);
					exit;
				}

			}

		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
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
				{	$form = new UserRegisterar();
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
		$this->render('forgot_password/forgotPassword',array('form'=>$form));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */


	public function actionRegisterUser()
	{
			
		
		$model=new LoginForm;
		$userloginform = new UserRegisterar();
		$companyloginform = new CompanyRegisterar();

		$userloginform->userDetails = new UserDetails();
		$companyloginform->company = new Company();
		//$userdetailmodel = new UserDetails();
		//$companydetailmodel = new Company();
		$industrydetail = Industry::model()->findAll();;
		$rangedetail = CompanyRanges::model()->findAll();;

		$reqparams = array('range'=>$rangedetail,'industry'=>$industrydetail);



		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($userloginform);

		if (isset($_POST['UserRegisterar'])) {
			$validationemail = new EMailValidation();
			$validationemail->email = $_POST['UserRegisterar']['email'];
			$validationemail->password = $userloginform->getGeneratedPlainPassword();
			$validationemail->ip = $_SERVER['REMOTE_ADDR'];
			$validationemail->time = time();
			$validationemail->session = md5($validationemail->time.rand(100000,999999));
			$validationemail->sessionLink = $this->createAbsoluteUrl('user/validate', array('code'=>$validationemail->session));
			
			
			$userloginform->attributes = $_POST['UserRegisterar'];
			$userloginform->verifyCode = $validationemail->session;
			$userloginform->validationEmailLink = $validationemail->sessionLink;
			$userloginform->fullname = $_POST['UserDetails']['first_name'].' '.$_POST['UserDetails']['last_name'];
			$userloginform->password = $userloginform->getGeneratedPassword();
			
			
			$userloginform->userDetails->attributes = $_POST['UserDetails'];
			
			$userloginform->userDetails->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$userloginform->userDetails->modified_date = $userloginform->userDetails->create_date ;
			
			$userloginform->userDetails->user_id = 0;
			
			$vaidate = $userloginform->validate();
			$vaidate2 = $userloginform->userDetails->validate();
			
			
			
			if($vaidate && $vaidate2){
			
			
			
			$transaction=Yii::app()->db->beginTransaction();
			try {
			

				
				if ($userloginform->save()) {
					$userloginform->userDetails->user_id = $userloginform->id;
					if ($userloginform->userDetails->save()) {
						
						$validationemail->userID = $userloginform->id;
						if($validationemail->save())
						{
							// save user registration

							$transaction->commit();
							$this->render('thankyou_user',array('form'=>$validationemail));
							return;



						}
						else{
							$transaction->rollBack();

						}
						//$transaction->commit();

						//$this->redirect(array('view', 'id' => $userloginform->id));
					}
				}
				//something went wrong...
				$transaction->rollBack();
			}
			catch(Exception $e) { // an exception is raised if a query fails
				//something was really wrong - exception!
				if($transaction->active){
					$transaction->rollBack();
				}
				//you should do sth with this exception (at least log it or show on page)
				Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
			}
		}

		}
		$this->render('registeration/user/index',array('model'=>$model,'userloginform'=>$userloginform,'companyloginform'=>$companyloginform,'reqparams'=>$reqparams));

	}




	public function actionRegisterCompany()
	{
		
		$person = new Person;
		$model=new Company;
		$companydetailmodel = new Company;

		$model=new LoginForm;
		$userloginform = new UserRegisterar();
		$companyloginform = new CompanyRegisterar();

		$userloginform->userDetails = new UserDetails();
		$companyloginform->company = new Company();
		//$userdetailmodel = new UserDetails();
		//$companydetailmodel = new Company();
		$industrydetail = Industry::model()->findAll();;
		$rangedetail = CompanyRanges::model()->findAll();;

		$reqparams = array('range'=>$rangedetail,'industry'=>$industrydetail);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CompanyRegisterar']))
		{

			$validationemail = new EMailValidation();
			$validationemail->email = $_POST['CompanyRegisterar']['email'];
			$validationemail->password = $userloginform->getGeneratedPlainPassword();
			$validationemail->ip = $_SERVER['REMOTE_ADDR'];
			$validationemail->time = time();
			$validationemail->session = md5($validationemail->time.rand(100000,999999));
			$validationemail->sessionLink = $this->createAbsoluteUrl('user/validate', array('code'=>$validationemail->session));

			$companyloginform->attributes = $_POST['CompanyRegisterar'];
			$companyloginform->verifyCode = $validationemail->session;
			$companyloginform->validationEmailLink = $validationemail->sessionLink;
			$companyloginform->fullname = $_POST['Company']['name'];
			$companyloginform->password = $companyloginform->getGeneratedPassword();
			
			
			$companyloginform->company->attributes = $_POST['Company'];
			$companyloginform->company->user_id = $companyloginform->id;
			$companyloginform->company->industry_id = $_POST['Industry']['id'];
			$companyloginform->company->range_id = $_POST['CompanyRanges']['id'];
			
			
			
			
			$vaidate = $companyloginform->validate();
			$vaidate2 = $companyloginform->company->validate();
			
			if($vaidate && $vaidate2){
			

			try {
				
				
				
				
				
				
				
				$transaction=Yii::app()->db->beginTransaction();
				if ($companyloginform->save()) {
					
					if ($companyloginform->company->save()) {
						$validationemail->userID = $companyloginform->id;
						if($validationemail->save())
						{
							// save user registration

							$transaction->commit();
							$validationemail->company_name = $_POST['Company']['name'];
							$this->render('thankyou_company',array('form'=>$validationemail));
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
					//print_r($companyloginform);
				}

			}
			catch(Exception $e) { // an exception is raised if a query fails
				//something was really wrong - exception!



				//$transaction->rollBack();

				//you should do sth with this exception (at least log it or show on page)
				Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );

			}
		}
		}
		$this->render('registeration/company/index',array('model'=>$model,'userloginform'=>$userloginform,'companyloginform'=>$companyloginform,'reqparams'=>$reqparams));
			
	}


	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		
			echo CActiveForm::validate($model);
			Yii::app()->end();
		
	}
	

}
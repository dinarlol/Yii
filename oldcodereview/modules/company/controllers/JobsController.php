<?php
class JobsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
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
						'actions'=>array('index','view'),
						'users'=>array('*'),
				),
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('watch'),
						'roles'=>array(AkimboNuggetManager::USER_ROLE),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','delete','visitProfile','applicationStatus','sendMessage'),
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
	
	
	public function  actionWatch($id){
		
		$watch = new JobWatch();
		$watch->user_id = Yii::app()->user->getId();
		$watch->post_job_id = $id;
		$watch->watch = 1;
		$watch->create_date = AkimboNuggetManager::getSqlCurrentDate();
		$watch->modified_date = $watch->create_date;
		$watch->save(); 		
		echo CHtml::ajaxLink("Watching", Yii::app()->createAbsoluteUrl("company/jobs/watch",array("id"=>$id)),array("update"=>"#job_watch_update_$id"));
	}
	
	
	public function actionSendMessage($id,$jobId){
		
		$message = new UserMailBoxMails();
		
		
		if (Yii::app()->request->getPost('UserMailBoxMails')) {
			
			$message->attributes = Yii::app()->request->getPost('UserMailBoxMails');
			$message->senderUserId = Yii::app()->user->getId();
			$message->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$message->modified_date = $message->create_date;
			
		
			
			if(isset($_POST['ajax']) &&  $_POST['ajax'] === 'job-message-form')
			{
				echo  CActiveForm::validate($message);
				Yii::app()->end();
				
				
			}
			
			$message->save();
			$this->actionView(Yii::app()->request->getPost('jobId'));
			
			
			
		}
		else{
		$receiverName = Person::model()->findByPk($id)->getFullName();
		$message->receiverUserId = $id;
		$message->senderUserId = Yii::app()->user->getId();
		$message->create_date = AkimboNuggetManager::getSqlCurrentDate();
		$message->modified_date = $message->create_date;
		$this->renderPartial('sendMessage', 
				array('model'=>$message,'receiverName'=>$receiverName,'jobId'=>$jobId),
				false,true);
	}
	}
	
	
	
	public function actionFlag($pk, $name, $value){
		$model = $this->loadModel($pk);
		$model->{$name} = $value;
		//$model->save(false);
		if(!Yii::app()->request->isAjaxRequest){
			$this->redirect('admin');
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

		$JobStats = JobStats::model()->findAll("post_job_id = :post_job_id", array(":post_job_id"=>$id));
		
		
		$model = new JobStats();
		$model->unsetAttributes();
		$model->post_job_id = $id;
		$model->deleted_messages = false;
		$model->application_status  = '<>DELETE';
		
		if(isset($_GET['JobStats']['status'])){
			
			if($_GET['JobStats']['status'] === 'Delete')
				$model->deleted_messages = true;
			$model->application_status  = $_GET['JobStats']['status'];
		}
		
				
		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'jobStats'=>$JobStats,
				'jobApplications' => $model,
		));

	}

	public function actionVisitProfile($jobPostId,$user_id)
	{
		JobStats::model()->updateAll(array("visited"=>"1"), "id = '".$jobPostId."'");
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new PostJob;
		$PostJobLocation = new PostJobLocation();
		$PostJobRequirement = new PostJobRequirement();
		$PostJobRequirementOpt = new PostJobRequirmentOptional();


		if(isset($_POST['PostJob']))
		{
			 
			$model->attributes=$_POST['PostJob'];
			$PostJobLocation->attributes = $_POST['PostJobLocation'];
			$PostJobRequirement->attributes = $_POST['PostJobRequirement'];
			$PostJobRequirementOpt->attributes = $_POST['PostJobRequirmentOptional'];

			$model->employer_id = Yii::app()->user->getId();
			$model->create_date = date("Y-m-d H:i:s");
			$model->modified_date = date("Y-m-d H:i:s");


			$valid = $model->validate();
			$valid = $PostJobLocation->validate() && $valid;
			 
			$validPostJob = $model->validate();
			$validJobLoc = $PostJobLocation->validate();
			$validJobReq = $PostJobRequirement->validate();
			$valid = $validPostJob && $validJobLoc && $validJobReq;
			 
			if($valid)
			{
				if($model->save())
				{
					$jobPostId = $model->id;
					$PostJobLocation->job_post_id = $jobPostId;
					$PostJobRequirement->job_post_id = $jobPostId;
					$PostJobRequirementOpt->post_job_id = $jobPostId;

					$PostJobLocation->save();
					$PostJobRequirement->save();
					$PostJobRequirementOpt->save();

					$this->redirect(array('index'));
				}
			}

		}

		$this->render('_form',array('model'=>$model,
				'postJobModel'=>$PostJobLocation,
				'postJobRequirement'=>$PostJobRequirement,
				'postJobRequirementOpt'=>$PostJobRequirementOpt));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$PostJobLocation = $this->loadModelPostJobLoc($id);
		$PostJobRequirement = $this->loadModelPostReq($id);
		$PostJobRequirementOpt = $this->loadModelPostReqOpt($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PostJob']))
		{
			$model->attributes=$_POST['PostJob'];
			$PostJobLocation->attributes = $_POST['PostJobLocation'];
			$PostJobRequirement->attributes = $_POST['PostJobRequirement'];
			$PostJobRequirementOpt->attributes = $_POST['PostJobRequirmentOptional'];

			/*if($model->save())
				$this->redirect(array('view','id'=>$model->id));*/

			$valid = $model->validate();
			$valid = $PostJobLocation->validate() && $valid;

			$validPostJob = $model->validate();
			$validJobLoc = $PostJobLocation->validate();
			$validJobReq = $PostJobRequirement->validate();
			$valid = $validPostJob && $validJobLoc && $validJobReq;

			if($valid)
			{
				if($model->save())
				{

					$PostJobLocation->save();
					$PostJobRequirement->save();
					$PostJobRequirementOpt->save();

					$this->redirect(array('index'));
				}
			}

		}

		$this->render('update',array('model'=>$model,'postJobLoc'=>$PostJobLocation,
				'postJobReq'=>$PostJobRequirement,
				'postJobReqOpt'=>$PostJobRequirementOpt));
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
			if(!is_null($this->loadModelPostJobLoc($id)))
				$this->loadModelPostJobLoc($id)->delete();

			if(!is_null($this->loadModelPostReq($id)))
				$this->loadModelPostReq($id)->delete();

			if(!is_null($this->loadModelPostReqOpt($id)))
				$this->loadModelPostReqOpt($id)->delete();

			if(!is_null($this->loadModel($id)))
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

		$recommend = new JobRecommendations();
		if(isset($_POST['JobRecommendations']))
		{
			
			$recommend->attributes = $_POST['JobRecommendations'];
			$recommend->user_id = Yii::app()->user->id;
			$recommend->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$recommend->modified_date = $recommend->create_date;
			if(!empty($_POST['JobRecommendations']['recommender_id'])){
				$recommend->recommender_email = Person::model()->findByPk($_POST['JobRecommendations']['recommender_id'])->email;

			}
			else if(!empty($_POST['JobRecommendations']['externalRecommendedUser'])){
				$recommend->recommender_name = $recommend->externalRecommendedUser;
			}
				
				
			$this->performAjaxValidation($recommend);
				
			if($recommend->save()){
				$recommend = new JobRecommendations();
				Yii::log(' Mail sent for job recommendation to '.$recommend->recommender_name);

			}
			else{
				print_r($recommend);
			}
				
				
		}

		$groupselect = '';
		$dataProvider=new CActiveDataProvider('PostJob');
		$groups = Group::model()->findAll('name!=?',array(AkimboNuggetManager::SPECIAL_GROUP));
		//$groups->feedback_time='1';
		//$groups->obj_oid= 1;

		foreach ($groups as $group){
			//$group->feedback_time='1';
			if($group->name === AkimboNuggetManager::REGISTERED_GROUP){
				$group->name = 'Akimbo Users';
			}
			else{
				$group->name = 'External Users';
				$recommend->user_group_id = $group->id;

			}
		}

		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'recommender' =>$recommend,
				'groups' =>CHtml::listData($groups, 'id', 'name'),


		));
	}



	 

	/**
	 * Manages all models.
	 */
	public function actionApplicationStatus($statsId,$id)
	{
		
		if(isset($_POST['JobStats']))
		{
			$jobStats = JobStats::model()->findByPk($statsId);
			$status = $_POST['JobStats']['application_status'];
			if(empty($status)) $status = "PENDING";
			
			$jobStats->application_status = strtoupper($status);
						if($jobStats->save()){
							
							/*
							unset($_POST['JobStats']);
							
							Yii::log('Starting background task...');
							//print_r($_POST);exit;

							
							if (ERunActions::runBackground())
							{
							*/
								Yii::log('Starting background task...', CLogger::LEVEL_WARNING, 'CFileLogRoute');
								
								
							
								//... time-consuming code here
							
							
							
								$subject = "Job Update from Akimbo.com for job ".$jobStats->job->job_title;
								$body = '
								<html>
								<head>
								<title></title>
								<style>
								body {
								color: #8BB3DA;
							}
							</style>
							</head>
							<body style="background-color: #161616;">
							<div style="margin-left: 10%; margin-top: 5%; background-color: #191919; color: #8BB3DA; width: 600px; overflow: none;">
							<h1>Hello Testing only ,</h1><br/><br/>
							
							Your application for job '.$jobStats->job->job_title.' has been '.$status.'  by the Employer
							<br/>
							If you have any troubles an administrator can assist you. Just contact Webmaster@Akimbo.com.<br/><br/>
							
							<table cellspacing="0" cellpadding="0" width="600px">
							<tr><td colspan="2">Account Details</td></tr>
							<tr><td>Username:</td><td></td></tr>
							<tr><td>Password:</td><td></td></tr>
							<tr><td>Email:</td><td></td></tr>
							
							</table><br/><br/>
							
							Best regards,<br/>
							Web Administration
							</div>
							</body>
							</html>
							';
							
								// To send HTML mail, you can set the Content-type header.
								$contentType = 'text/html';
								$charset='iso-8859-1';
								$message = new YiiMailMessage();
							
								$message->setTo(
										array('dinarlol@yahoo.com'=>'dinar'));
								$message->setFrom(array('donotreply@akimbo.com'=>'Akimbo'));
								$message->setSubject($subject);
								$message->setBody($body,$contentType,$charset);
							
								$numsent = Yii::app()->mail->send($message);
							
							
							/*
								//Inform the user if 'hasFlash' is implemented in all views
								Yii::app()->user->setFlash('runbackground','Process finished');
							
								Yii::log('Background task executed');
								Yii::app()->end();
							}

							*/
							$this->actionView($id);
							
						}
						else{
							
						}
			

		}
		

	}

	public function actionAdmin()
	{
		$model=new PostJob('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PostJob']))
			$model->attributes=$_GET['PostJob'];

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
		$model=PostJob::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadModelPostJobLoc($jobPostId)
	{
		$model = PostJobLocation::model()->find("job_post_id = :job_post_id", array(":job_post_id"=>$jobPostId));
		return $model;
	}

	public function loadModelPostReq($jobPostId)
	{
		$model = PostJobRequirement::model()->find("job_post_id = :job_post_id", array(":job_post_id"=>$jobPostId));
		return $model;
	}

	public function loadModelPostReqOpt($jobPostId)
	{
		$model = PostJobRequirmentOptional::model()->find("post_job_id = :job_post_id", array(":job_post_id"=>$jobPostId));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-job-form' || $_POST['ajax'] === 'job-message-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

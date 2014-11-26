<?php
class ManagePostController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','visitProfile','applicationStatus'),
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
		
            $JobStats = JobStats::model()->findAll("post_job_id = :post_job_id", array(":post_job_id"=>$id)); 
            $this->render('view',array(
			'model'=>$this->loadModel($id),
                        'jobStats'=>$JobStats,
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
            
                $dataProvider=new CActiveDataProvider('PostJob');
                $this->render('index',array(
			'dataProvider'=>$dataProvider,
                
		));
	}

	/**
	 * Manages all models.
	 */
        public function actionApplicationStatus()
        {
           $JobStats = new JobStats(); 
           if(isset($_POST['status']))
           {
               $statsId = $_REQUEST['statsId'];
               $status = $_POST['status'];
            
               if(empty($status)) $status = "Pending";
               //$PostJob = PostJob::model()->findByPk($postId)->update(array("application_status"=>$status));
               $JobStats->updateAll(array("application_status"=>$status), "id = '".$statsId."'"); 
               
              
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-job-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

<?php

class BankController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('admin'),
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
		$model=new Bank;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bank']))
		{
			$model->attributes=$_POST['Bank'];
if($_POST['Bank']['user_name'] != 'admin')
$user = Users::model()->find("username=?",  array(strtoupper($_POST['Bank']['user_name'])));
else $user = Users::model()->find("username=?",  array($_POST['Bank']['user_name']));
			$model->uid = $user->user_id;
                      
                    
			if($model->save())
				$this->redirect(array('view','id'=>$model->bank_id));
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bank']))
		{
			$model->attributes=$_POST['Bank'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->bank_id));
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
		$dataProvider=new CActiveDataProvider('Bank');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	
		$model=new Bank('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bank']))
			$model->attributes=$_GET['Bank'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
	/*public function actionAdmin() {

        $authorzied = Yii::app()->user->getState("authorziedConfirm", false);


        if (isset($_POST['Users'])) {
            $user = Users::model()->findbypk(yii::app()->user->getId());

            if ($user->security_quest_id == $_POST['Users']['security_quest_id'] && $user->answer == $_POST['Users']['answer'] && $user->pincode == $_POST['Users']['pincode']) {
                $model = new Users('search');
                if (!$authorzied) {
                    Yii::app()->user->setState("authorziedConfirm", true);
                    $authorzied = TRUE;
                }
                $model->unsetAttributes();  // clear any default values

                $model->user_id = yii::app()->user->getId();
                if (isset($_GET['Users']))
                    $model->attributes = $_GET['Users'];
            }
        }
		
		if (!$authorzied) {
            $model = new Users();
            return $this->render('verify', array(
                        'model' => $model,
            ));
        }

        $nmodel = new Bank('search');

        $nmodel->user_id = yii::app()->user->getId();
        if (isset($_GET['Bank']))
            $nmodel->attributes = $_GET['Bank'];
        return $this->render('admin', array(
                    'model' => $nmodel,
        ));
    }*/
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	 
	 
	 
	 
	 
	public function loadModel($id)
	{
		$model=Bank::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='bank-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

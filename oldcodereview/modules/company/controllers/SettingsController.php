<?php

class SettingsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/company';
	
	
	
	public function accessRules()
	{
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('index','resetpass'),
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
	
	
	public function actionIndex()
	{
		
		$this->redirect("?r=company/details");
	}
	
	public function  actionResetPass(){
		$model=$this->loadModel(yii::app()->user->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Person']))
		{
			$model->attributes=$_POST['Person'];
			$model->repeat_email = $model->email;
			$model->repeat_password= md5(md5($_POST['Person']['repeat_password']).Yii::app()->params["@k!MbO"]);
			$model->password= md5(md5($_POST['Person']['password']).Yii::app()->params["@k!MbO"]);
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('resetpass',array(
			'model'=>$model,
		));
		$this->layout='//layouts/footer';
		$this->render('blank');
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Person::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
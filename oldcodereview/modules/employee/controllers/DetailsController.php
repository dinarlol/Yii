<?php

class DetailsController extends Controller
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
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','index','view'),
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
	

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UserDetails', array(
				'criteria'=>array(
						'condition'=>'user_id='.Yii::app()->user->id,
				
				),
		));
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout='//layouts/column2';
		$this->render('view',array(
				'model'=>$this->loadModel($id),
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
	
		if(isset($_POST['UserDetails']))
		{
			$model->attributes=$_POST['UserDetails'];
			if($model->save()){
			//	$this->redirect(array('view','id'=>$model->user_id));
			}
		}
	
		$this->render('update',array(
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
		$criteria = new CDbCriteria();
		$criteria->compare('user_id', $id);
		$model=UserDetails::model()->find($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
}
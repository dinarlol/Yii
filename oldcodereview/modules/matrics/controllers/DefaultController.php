<?php

class DefaultController extends Controller
{
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
	public $portlets = array('RecentUploads'=>array(),'RecentRecomendation'=>array(),'recentSiteMatrics'=>array());
	
	
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
				array('allow',  // allow all users to perform 'index'  actions
						'actions'=>array('index'),
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionIndex()
	{
		$matrics = new UsersSiteMatrics();
		$matrics->unsetAttributes();
		
		$matrics->owner_user_id = Yii::app()->user->id;
		$this->render('index',array('matrics'=>$matrics));
	}
}
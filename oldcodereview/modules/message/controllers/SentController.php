<?php

class SentController extends Controller
{
	public $defaultAction = 'sent';


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('sent'),
						'users'=>array('@'),
				),

				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}



	public function actionSent() {
		$messagesAdapter = UserMailBoxMails::getAdapterForSent(Yii::app()->user->getId());
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);

		$this->render(Yii::app()->getModule('message')->viewPath . '/sent', array(
				'messagesAdapter' => $messagesAdapter
		));
	}
}

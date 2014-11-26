<?php

class InboxController extends Controller
{
	public $defaultAction = 'inbox';
	
	
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('inbox','draft'),
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

	public function actionInbox() {
		$messagesAdapter = UserMailBoxMails::getAdapterForInbox(Yii::app()->user->getId());
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);

		$this->render(Yii::app()->getModule('message')->viewPath . '/inbox', array(
			'messagesAdapter' => $messagesAdapter
		));
	}
	
	
	
	public function actionDraft() {
		$messagesAdapter = UserMailBoxDrafts::getAdapterForDraft(Yii::app()->user->getId());
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);
	
		$this->render(Yii::app()->getModule('message')->viewPath . '/draft', array(
				'messagesAdapter' => $messagesAdapter
		));
	}
}

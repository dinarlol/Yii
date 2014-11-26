<?php

class ComposeController extends Controller
{

	public $defaultAction = 'compose';


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('compose','draft'),
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
	
	
	
	
	public function actionCompose($id = null) {
		
		
		$message = new UserMailBoxMails();
		
		if (Yii::app()->request->getPost('UserMailBoxMails')) {
			if(isset($_POST['drafts'])){
				$this->actionDraft($id);
				return;
			}
			
			$receiverName = Yii::app()->request->getPost('receiver');
		    $message->attributes = Yii::app()->request->getPost('UserMailBoxMails');
			$message->senderUserId = Yii::app()->user->getId();
			$message->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$message->modified_date = $message->create_date;
			if ($message->save()) {
				Yii::app()->user->setFlash('messageModule', MessageModule::t('Message has been sent'));
				//Yii::app()->user->setFlash('messageModuleNewMail', MessageModule::t( Yii::app()->getModule('message')->getCountUnreadedMessages($message->receiverUserId)));
			    $this->redirect($this->createUrl('inbox/'));
			} else if ($message->hasErrors('receiverUserId')) {
				$message->receiverUserId = null;
				$receiverName = '';
			}
		} else {
			
			if ($id) {
				$receiver = call_user_func(array(call_user_func(array(Yii::app()->getModule('message')->userModel, 'model')), 'findByPk'), $id);
				if ($receiver) {
					$receiverName = call_user_func(array($receiver, Yii::app()->getModule('message')->getNameMethod));
					$message->receiverUserId = $receiver->id;
				}
			}
		}
		$this->render(Yii::app()->getModule('message')->viewPath . '/compose', array('model' => $message, 'receiverName' => isset($receiverName) ? $receiverName : null));
	}
	
	
	public function actionDraft($id = null) {
		$message = new UserMailBoxDrafts();
	
		if (Yii::app()->request->getPost('UserMailBoxMails')) {
	
			$receiverName = Yii::app()->request->getPost('receiver');
			$message->attributes = Yii::app()->request->getPost('UserMailBoxMails');
			$message->senderUserId = Yii::app()->user->getId();
			$message->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$message->modified_date = $message->create_date;
			if ($message->save()) {
				Yii::app()->user->setFlash('messageModule', MessageModule::t('Draft has been saved'));
				$this->redirect($this->createUrl('inbox/draft'));
			} else if ($message->hasErrors('receiverUserId')) {
				$message->receiverUserId = null;
				$receiverName = '';
			}
		} else {
	
			if ($id) {
				$receiver = call_user_func(array(call_user_func(array(Yii::app()->getModule('message')->userModel, 'model')), 'findByPk'), $id);
				if ($receiver) {
					$receiverName = call_user_func(array($receiver, Yii::app()->getModule('message')->getNameMethod));
					$message->receiverUserId = $receiver->id;
				}
			}
		}
		$this->render(Yii::app()->getModule('message')->viewPath . '/draft', array('model' => $message, 'receiverName' => isset($receiverName) ? $receiverName : null));
	}
}

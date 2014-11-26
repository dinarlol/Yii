<?php

class ViewController extends Controller {

	public $defaultAction = 'view';


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('compose','draft','view'),
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



	public function actionView() {
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = UserMailBoxMails::model()->findByPk($messageId);

		if (!$viewedMessage) {
			throw new CHttpException(404, MessageModule::t('Message not found'));
		}

		$userId = Yii::app()->user->getId();

		if ($viewedMessage->senderUserId != $userId && $viewedMessage->receiverUserId != $userId) {
			throw new CHttpException(403, MessageModule::t('You can not view this message'));
		}
		/*
		 if (($viewedMessage->senderUserId == $userId && $viewedMessage->sender_deleted == 1)
		 		|| $viewedMessage->receiverUserId == $userId && $viewedMessage->deleted_by == UserMailBoxMails::DELETED_BY_RECEIVER) {
		throw new CHttpException(404, MessageModule::t('Message not found'));
		}
		*/
		$message = new UserMailBoxMails();

		$isIncomeMessage = $viewedMessage->receiverUserId == $userId;
		if ($isIncomeMessage) {
			$message->subject = preg_match('/^Re:/',$viewedMessage->subject) ? $viewedMessage->subject : 'Re: ' . $viewedMessage->subject;
			$message->receiverUserId = $viewedMessage->senderUserId;
		} else {
			$message->receiverUserId = $viewedMessage->receiverUserId;
		}

		if (Yii::app()->request->getPost('UserMailBoxMails')) {
			$message->attributes = Yii::app()->request->getPost('UserMailBoxMails');
			$message->senderUserId = $userId;
			$message->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$message->modified_date = $message->create_date;
			if ($message->save()) {
				Yii::app()->user->setFlash('success', MessageModule::t('Message has been sent'));
				if ($isIncomeMessage) {
					$this->redirect($this->createUrl('inbox/'));
				} else {
					$this->redirect($this->createUrl('sent/'));
				}
			}
		}

		if ($isIncomeMessage) {
			$viewedMessage->markAsRead();
		}

		$this->render(Yii::app()->getModule('message')->viewPath . '/view', array('viewedMessage' => $viewedMessage, 'message' => $message));
	}
	
	
	public function actionDraft($id=null) {
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = UserMailBoxDrafts::model()->findByPk($messageId);
		$receiverName = Yii::app()->request->getPost('receiver');

		if (Yii::app()->request->getPost('UserMailBoxDrafts')) {
			$message = UserMailBoxDrafts::model()->findByPk($messageId);
			$receiverName = Yii::app()->request->getPost('receiver');
			$message->attributes = Yii::app()->request->getPost('UserMailBoxDrafts');
			$message->senderUserId = Yii::app()->user->getId();
			$message->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$message->modified_date = $message->create_date;
			if ($message->update()) {
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



		if (!$viewedMessage) {
			throw new CHttpException(404, MessageModule::t('Message not found'));
		}

		$userId = Yii::app()->user->getId();

		if ($viewedMessage->senderUserId != $userId && $viewedMessage->receiverUserId != $userId) {
			throw new CHttpException(403, MessageModule::t('You can not view this message'));
		}
		/*
		 if (($viewedMessage->senderUserId == $userId && $viewedMessage->sender_deleted == 1)
		 		|| $viewedMessage->receiverUserId == $userId && $viewedMessage->deleted_by == UserMailBoxMails::DELETED_BY_RECEIVER) {
		throw new CHttpException(404, MessageModule::t('Message not found'));
		}
		*/

		$isIncomeMessage = $viewedMessage->receiverUserId == $userId;



		if (!$viewedMessage->isRead) {
			$viewedMessage->markAsRead();
		}

		$this->render(Yii::app()->getModule('message')->viewPath . '/_draft', array('viewedMessage' => $viewedMessage,  'receiverName' => isset($receiverName) ? $receiverName : null));
	}


	public function actionCompose($id = null) {


		$message = new UserMailBoxMails();

		if (Yii::app()->request->getPost('UserMailBoxDrafts')) {
			if(isset($_POST['drafts'])){
				$this->actionDraft($id);
				return;
			}

			$receiverName = Yii::app()->request->getPost('receiver');
			$message->attributes = Yii::app()->request->getPost('UserMailBoxDrafts');
			$message->senderUserId = Yii::app()->user->getId();
			$message->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$message->modified_date = $message->create_date;
			if ($message->save()) {
				Yii::app()->user->setFlash('messageModule', MessageModule::t('Draft Message has been sent'));
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





}

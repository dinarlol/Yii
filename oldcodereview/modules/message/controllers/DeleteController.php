<?php

class DeleteController extends Controller {

	public $defaultAction = 'delete';
	
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('delete','deleteDraft'),
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
	
	
	

	public function actionDelete($id = null) {
		
		
		if (!$id) {
			$messagesData = Yii::app()->request->getParam('UserMailBoxMails');
			$counter = 0;
			if ($messagesData) {
				foreach ($messagesData as $messageData) {
					if (isset($messageData['selected'])) {
						$message = UserMailBoxMails::model()->findByPk($messageData['id']);
						if (Yii::app()->user->getId() === $message->senderUserId) {
							$message->sender_deleted = 1;
							$message->update();
							$counter++;
						}
						if (Yii::app()->user->getId() === $message->receiverUserId) {
							$message->receiver_deleted = 1;
							$message->update();
							$counter++;
						}
					}
				}
			}
			if ($counter) {
				Yii::app()->user->setFlash('messageModule', MessageModule::t('Selected message'.($counter > 1 ? 's' : '').' has been deleted', array('{count}' => $counter)));
			}
			$this->redirect(Yii::app()->request->getUrlReferrer());
		} 
	}
	
	
	
	public function actionDeleteDraft($id = null) {
		if (!$id) {
			$messagesData = Yii::app()->request->getParam('UserMailBoxDrafts');
			$counter = 0;
			if ($messagesData) {
				foreach ($messagesData as $messageData) {
					if (isset($messageData['selected'])) {
						$message = UserMailBoxDrafts::model()->findByPk($messageData['id']);
						
					if (Yii::app()->user->getId() === $message->senderUserId) {
							$message->sender_deleted = 1;
							$message->update();
							$counter++;
						}
					}
				}
			}
			if ($counter) {
				Yii::app()->user->setFlash('messageModule', MessageModule::t('Selected  draft'.($counter > 1 ? 's' : '').' has been deleted', array('{count}' => $counter)));
			}
			$this->redirect(Yii::app()->request->getUrlReferrer());
		} 
	}
	
	
}

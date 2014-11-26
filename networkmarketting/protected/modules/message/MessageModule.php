<?php

class MessageModule extends CWebModule
{
	public $defaultController = 'inbox';

	public $userModel = 'User';
	public $dateFormat = 'Y-m-d H:i:s';
	public $getNameMethod;
	public $getSuggestMethod;

	public $inboxUrl = array("/message/inbox");

	public $viewPath = '/message/fancy';



	public function beforeControllerAction($controller, $action)
	{
		if (Yii::app()->user->isGuest) {
			if (Yii::app()->user->loginUrl) {
				$controller->redirect($controller->createUrl(reset(Yii::app()->user->loginUrl)));
			} else {
				$controller->redirect($controller->createUrl('/'));
			}
		} else if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		} else {
			return false;
		}
	}
	
	public static function t($str='',$params=array(),$dic='message') {
		return Yii::t("MessageModule.".$dic, $str, $params);
	}
	
	public function getCountUnreadedMessages($userId) {
		return UserMailBoxMails::model()->getCountUnreaded($userId);
	}

	

}

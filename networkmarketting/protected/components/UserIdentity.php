<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
       /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public $_id;
        public $username;
	public function authenticate()
	{

		$loginInfo=  Users::model()->find('LOWER(username)=?',array(strtolower($this->username)));

		if($loginInfo===null)
		$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$loginInfo->validatePassword($this->password)){
		$this->errorCode=self::ERROR_PASSWORD_INVALID;
		
		}
		else{

		$this->_id=$loginInfo->user_id;
		$this->username=$loginInfo->username;

		$auth = Yii::app()->authManager;
		if (!$auth->isAssigned($loginInfo->role->name, $this->_id)) {
			if(!$auth->getAuthItem($loginInfo->role->name))
			$auth->createAuthItem($loginInfo->role->name,2);
			if ($auth->assign($loginInfo->role->name, $this->_id)) {
				Yii::app()->authManager->save();
			}
		}
		
				
		$this->errorCode=self::ERROR_NONE;
		
		}
		

		return $this->errorCode==self::ERROR_NONE;
	}
        
          public function getId()
    {
        return $this->_id;
    }

}
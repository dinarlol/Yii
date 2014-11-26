<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;


	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

		$user=Person::model()->find('LOWER(email)=?',array(strtolower($this->username)));

		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword(md5(md5($this->password).Yii::app()->params["@k!MbO"])))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			if($user->role->name == $user->userRole){
					
				Yii::app()->user->setState('userRole',$user->userRole);
				Yii::app()->user->setState('isUser', true);
				Yii::app()->user->setState('isCompany', false);
				Yii::app()->user->setState('isAdmin', false);
			}
			else if($user->role->name == $user->companyRole){
				Yii::app()->user->setState('userRole',$user->companyRole);
				Yii::app()->user->setState('isUser',false);
				Yii::app()->user->setState('isCompany', true);
				Yii::app()->user->setState('isAdmin', false);
					
					
			}
			else if($user->role->name == $user->adminRole){
				Yii::app()->user->setState('userRole',$user->adminRole);
				Yii::app()->user->setState('isUser',false);
				Yii::app()->user->setState('isCompany', false);
				Yii::app()->user->setState('isAdmin', true);
					
			}
				
			$this->_id=$user->id;
			$this->username=$user->email;
				
				
			$auth = Yii::app()->authManager;
			if (!$auth->isAssigned($user->role->name, $this->_id)) {
				if(!$auth->getAuthItem($user->role->name))
					$auth->createAuthItem($user->role->name,2);
				if ($auth->assign($user->role->name, $this->_id)) {
					Yii::app()->authManager->save();
				}
			}
				

			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}
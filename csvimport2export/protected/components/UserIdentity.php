<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $log = new AuthLog();
        $log->user_id = $this->username;

        if ($this->username == Yii::app()->params['adminLoginName'] && $this->password == Yii::app()->params['adminLoginPassword']) {
            $this->username = 'admin';
            $this->_id = Yii::app()->params['adminLoginName'];
            $this->errorCode = self::ERROR_NONE;
            return true;
        }
        $user = Users::model()->find('LOWER(user_id)=?', array(strtolower($this->username)));
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($log->getFailedCount() > 2) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            Yii::app()->user->setFlash('error', "Account is lock wait for 24 hours to login we also had sent your password in email ");
            Yii::log("user " . $this->username . " 3 login failure trying to login again from ip " . Yii::app()->request->getUserHostAddress(), "info");
        } else if (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;

            $log->date = Controller::getSqlCurrentDate();
            $log->failed = 1;
            $log->save();
            if ($log->getFailedCount() == 3) {
               
                 Yii::log("user id " . $user->user_id . " send password to email because of 3 wrong password attemps using ip " . Yii::app()->request->getUserHostAddress(), "info");
                 $to = $user->email;
                    $subject = 'Password';
                    $message = $user->password;
                     $headers = "From: \"trustee@covenantclearinghouse.com\" <trustee@covenantclearinghouse.com>\n"; 
                     $headers .= "To: \"".$user->name."\" <".$user->email.">\n";
			$headers .= "Return-Path: <trustee@covenantclearinghouse.com>\n"; 
			$headers .= "Content-Type: text/HTML; charset=ISO-8859-1\n";
            

                    mail($to, $subject, $message, $headers);
                    Yii::app()->user->setFlash('success', "Password sent to your registered email please check and login after 24 hours as your account is lock now ");
                
                
            }
        } else {
            $this->_id = $user->user_id;
            $this->username = $user->name;
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

}

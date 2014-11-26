<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

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
    const ERROR_BAN_IDENTITY=3;
    
    public function authenticate() {

        $loginInfo = Users::model()->find('LOWER(username)=?', array(strtolower($this->username)));

        if ($loginInfo === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$loginInfo->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            if($loginInfo->ban){
               
                $this->errorCode = self::ERROR_BAN_IDENTITY;
               return false;
            }
             
            $this->_id = $loginInfo->id;
            $this->username = $loginInfo->username;
         
            UtilityManager::getMyWallet($this->_id);
            
            /*
            $pass = UtilityManager::getMyWalletIdentity($this->_id, $this->password);
           echo "passs is $pass";
           
           $enc = urlencode(UtilityManager::encrypt(base64_encode($pass), $this->password));
           echo "<p> saved pass in db was $enc";
           
           exit;
          /* encryption
            $ident = base64_decode($wallet->identifier);
           // print_r($ident);exit;
            $wallet->identifier = urlencode(UtilityManager::encrypt(base64_encode($ident), $this->password));
            $wallet->save();
            print_r($wallet);
            exit;
            
           /*
           *  decryption
           */
           /*
            print($wallet->identifier."<p></p>");
            $ident = urldecode($wallet->identifier);
            print($ident." identifier<p></p>");
            $dec  = UtilityManager::decrypt($ident, $this->password);
            print($dec."<p> encode</p>");
            $decr = base64_decode($dec);
            print($decr."<p> decrypted</p>");
            exit;
            */
            
            $auth = Yii::app()->authManager;
            if (!$auth->isAssigned($loginInfo->role->name, $this->_id)) {
                if (!$auth->getAuthItem($loginInfo->role->name))
                    $auth->createAuthItem($loginInfo->role->name, 2);
                if ($auth->assign($loginInfo->role->name, $this->_id)) {
                    Yii::app()->authManager->save();
                }
            }

            $loginInfo->scenario = 'login';
            $loginInfo->last_login = UtilityManager::getSqlCurrentDate();
            $loginInfo->update();
            $this->errorCode = self::ERROR_NONE;
            
            $this->setState("username", $this->username);
        }


        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId() {
        return $this->_id;
    }
    
     public function getUsername() {
        return $this->username;
    }

}

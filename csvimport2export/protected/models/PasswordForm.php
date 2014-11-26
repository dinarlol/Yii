<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PasswordForm extends CFormModel
{
	public $user_id;
	public $name;
	public $email;
        public $repeat_email;
        public $state;
        public $tel;
        public $cell;
        public $tax_id;




        /**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
            array('attn,street, state, city, zip,tel, cell, email', 'default', 'value' => '', 'setOnEmpty' => true),
            array('user_id', 'length', 'max'=>55),
                    array('email','email'),
                    array('repeat_email', 'compare', 'compareAttribute'=>'email', 'message' => 'Email not match'),
            array('password, name, email, tax_id', 'length', 'max'=>99),
            array('attn, city', 'length', 'max'=>123),
            array('street', 'length', 'max'=>124),
            array('state', 'length', 'max'=>33),
            array('zip', 'length', 'max'=>12),
            array('tel, cell', 'length', 'max'=>19),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('date_modified, user_id, password, name, attn, street, city, state, zip, tel, cell, email, tax_id', 'safe', 'on'=>'search'),
        );
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
                    'user_id' => ' User I.D: <br> (Also called Agent I.D Beneficiary I.D or Licensee I.D Typically 4 or 5 numbers)'
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		$this->_identity=new UserIdentity(trim($this->username),$this->password);
		if(!$this->_identity->authenticate())
			$this->addError('password','Incorrect username or password.');
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity(trim($this->username),$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}

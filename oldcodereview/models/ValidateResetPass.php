<?php

/**
 * This is the model class for table "ak_validate_reset_pass".
 *
 * The followings are the available columns in table 'ak_validate_reset_pass':
 * @property string $userID
 * @property string $id
 * @property string $email
 * @property string $ip
 * @property string $time
 * @property string $session
 */
class ValidateResetPass extends CActiveRecord
{
	public $stage = "Not Applicable";
	public $emailed = "Not Applicable";
	private $emailPassword;
	public $ip;
	public $time;
	public $validationEmailLink;
	public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @return ValidateResetPass the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_validate_reset_pass';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID, email, ip, time, session', 'required'),
			array('userID', 'length', 'max'=>14),
			array('email', 'length', 'max'=>256),
			array('ip', 'length', 'max'=>15),
			array('time', 'length', 'max'=>10),
			array('session', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userID, id, email, ip, time, session', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * confirmation email
	 */
	public function afterSave(){
	
		$subject = "Password Reset Request - Akimbo";
		$body = '
		<html>
		<head>
		<title>Akimbo Password Restet</title>
		<style>
		body {
		color: #8BB3DA;
		]
		</style>
		</head>
		<body style="background-color: #161616;">
		<div style="margin-left: 10%; margin-top: 5%; background-color: #191919; color: #8BB3DA; width: 600px; overflow: none;">
		<h1>Hello '. $this->email.',</h1><br/><br/>
	
		Akimbo had recieved a request for password request. Please confirm your <a href="'. $this->validationEmailLink.'"> email </a>
		if you want to reset the password.<br/><br/>
	
		If the above link doesnt work please copy and past the url in browser
		'. $this->validationEmailLink .'<br/><br/>
	
		Best regards,<br/>
		AKIMBO TEAM
		Web Administration
		</div>
		</body>
		</html>
		';
		$contentType = 'text/html';
		$charset='iso-8859-1';
		$message = new YiiMailMessage();
		
		$message->setTo(
				array($this->email=>'myname'));
		$message->setFrom(array($this->email=>$this->email));
		$message->setSubject($subject);
		$message->setBody($body,$contentType,$charset);
		
		$numsent = Yii::app()->mail->send($message);
		
		// Mailing process
		if($numsent)
		{
			$this->emailed = "Sent";
		}
		else{
			$this->emailed = "NO Sent";
		}
		
		return true;
		
	
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userID' => 'User',
			'id' => 'ID',
			'email' => 'Email',
			'ip' => 'Ip',
			'time' => 'Time',
			'session' => 'Session',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('session',$this->session,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
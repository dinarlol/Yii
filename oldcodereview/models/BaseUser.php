<?php

/**
 * This is the base class for all user type accounts
 * it encode password
 * sends notification emails
 * 
 */
Yii::import('ext.yii-mail.*');
class BaseUser extends AkimboRecord
{
	public $repeat_password;
	public $initialPassword;
	public $repeat_email;
	public $initialEmail;
	public $role_id;
	public $group_id;
	public $verifyCode;
	public $emailed;
	public $validationEmailLink;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Person the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Sets the default values
	 * @see CActiveRecord::init()
	 */
	public function init(){
		$date = date('Y-m-d H:i:s');
		$this->create_date = $date;
		$this->modified_date = $date;
	}


		
	
	public function beforeSave()
	{
		// in this case, we will use the old hashed password.
		if(empty($this->password) && empty($this->repeat_password) && !empty($this->initialPassword)){
			$this->password=$this->repeat_password=$this->initialPassword;
			$pass = md5(md5($this->password).Yii::app()->params["@k!MbO"]);
			$this->password=$pass;
			
		}
	
		return parent::beforeSave();
	}
	
	public function afterFind()
	{
		
		//reset the password to null because we don't want the hash to be shown.
		$this->initialPassword = $this->password;
		$this->password = null;
	
		parent::afterFind();
	}
	


	
	public function saveModel($data=array())
	{
		
		//because the hashes needs to match
		if(!empty($data['password']) && !empty($data['repeat_password']))
		{
			$data['password'] = Yii::app()->user->hashPassword($data['password']);
			$data['repeat_password'] = Yii::app()->user->hashPassword($data['repeat_password']);
		}
	
		$this->attributes=$data;
		
	
		if(!$this->save())
			return CHtml::errorSummary($this);
	
		return true;
	}
	
	/**
	 * @return actions to perform after saving ie: Send email with account info
	 */
	public function afterSave()
	{
		/*
		 * This is the Registration Email setup
		*/
		
		$subject = "Registration Details - Akimbo";
		$body = '
		<html>
		<head>
		<title>Akimbo Registration Details</title>
		<style>
		body {
		color: #8BB3DA;
		]
		</style>
		</head>
		<body style="background-color: #161616;">
		<div style="margin-left: 10%; margin-top: 5%; background-color: #191919; color: #8BB3DA; width: 600px; overflow: none;">
		<h1>Hello '. $this->email.',</h1><br/><br/>
		
		Thank you for registering to Sterling Savvy Web Design. As a new member to our site
		you will be allowed to visit more pages and access more information. As well if you
		were looking for our services, you can now sign up as a client to us. Please take the
		time to read our full policy, privacy and terms of service pages (located in the footer
		of every page) for our guarantee and site rules. Know that we will not share your email
		address to any other company without your given permission nor will you receive emails
		from us unless you sign up for them. The only exception to this would be web administration
		emails regarding your account.<br/><br/>
		
		Here are the detaisl of your registration, please do not lose this information and keep it safe
		from others. In the event you forget your password we have a password recovery setup
		where your secret question will be displayed so your secret answer would then be required
		to confirm the operation of a password change. If you have any troubles with this an administrator
		can assist you. Just contact Webmaster@SterlingSavvy.com.<br/><br/>
		
		<table cellspacing="0" cellpadding="0" width="600px">
		<tr><td colspan="2">Account Details</td></tr>
		<tr><td>Username:</td><td>'. $this->email .'</td></tr>
		<tr><td>Password:</td><td>'. $this->initialPassword .'</td></tr>
		<tr><td>Email:</td><td>'. $this->email .'</td></tr>
		<tr><td>Secret Question:</td><td>'. $this->email .'</td></tr>
		<tr><td>Secret Answer:</td><td>'. $this->email .'</td></tr>
		</table><br/><br/>
		
		Best regards,<br/>
		AKIMBO TEAM
		Web Administration
		</div>
		</body>
		</html>
		';
		// To send HTML mail, you can set the Content-type header.
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
				'companys' => array(self::HAS_MANY, 'Company', 'user_id'),
				'professions' => array(self::HAS_MANY, 'Profession', 'user_id'),
				'scienceTechnologys' => array(self::HAS_MANY, 'ScienceTechnology', 'user_id'),
				'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
				'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
				'userAboutMes' => array(self::HAS_MANY, 'UserAboutMe', 'user_id'),
				'userAcademics' => array(self::HAS_MANY, 'UserAcademic', 'user_id'),
				'userAwards' => array(self::HAS_MANY, 'UserAwards', 'user_id'),
				'userContacts' => array(self::HAS_MANY, 'UserContact', 'user_id'),
				'userDetails' => array(self::HAS_ONE, 'UserDetails', 'user_id'),
				'userHobbies' => array(self::HAS_MANY, 'UserHobbies', 'user_id'),
				'userLookingFors' => array(self::HAS_MANY, 'UserLookingFor', 'user_id'),
				'userMilitaryServices' => array(self::HAS_MANY, 'UserMilitaryService', 'user_id'),
				'userMusics' => array(self::HAS_MANY, 'UserMusic', 'user_id'),
				'userStories' => array(self::HAS_MANY, 'UserStory', 'user_id'),
				'userVolunteerisms' => array(self::HAS_MANY, 'UserVolunteerism', 'user_id'),
				'userWorkExperiences' => array(self::HAS_MANY, 'UserWorkExperience', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'group_id' => 'Group',
				'role_id' => 'Role',
				'email' => 'Email',
				'password' => 'Password',
				'repeat_password' => 'Confirm Password',
				'repeat_email' => 'Confirm Email',
				'status' => 'Status',
				'lng' => 'Lng',
				'lat' => 'Lat',
				'create_date' => 'Create Date',
				'modified_date' => 'Modified Date',
		);
	}
	/**
	 * to validate password at login time
	 */
	public function validatepassword($pass)
	{
		if($this->initialPassword == $pass){
			return true;
		}
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

		$criteria->compare('id',$this->id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}
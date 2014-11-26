<?php

/**
 * This is the model class for table "ak_user".
 *
 * The followings are the available columns in table 'ak_user':
 * @property integer $id
 * @property integer $group_id
 * @property integer $role_id
 * @property string $email
 * @property string $password
 * @property string $status
 * @property string $lng
 * @property string $lat
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property Company[] $companys
 * @property Profession[] $professions
 * @property ScienceTechnology[] $scienceTechnologys
 * @property Group $group
 * @property Roles $role
 * @property UserAboutMe[] $userAboutMes
 * @property UserAcademic[] $userAcademics
 * @property UserAwards[] $userAwards
 * @property UserContact[] $userContacts
 * @property UserDetails[] $userDetails
 * @property UserHobbies[] $userHobbies
 * @property UserLookingFor[] $userLookingFors
 * @property UserMilitaryService[] $userMilitaryServices
 * @property UserMusic[] $userMusics
 * @property UserStory[] $userStories
 * @property UserVolunteerism[] $userVolunteerisms
 * @property UserWorkExperience[] $userWorkExperiences
 */
Yii::import('ext.yii-mail.*');
class ForgotPassword extends CActiveRecord
{
	
	
	public $password2;
	public $stage = "Not Applicable";
	public $emailed = "Not Applicable";
	private $emailPassword;
	public $ip;
	public $time;
	public $validationEmailLink;
	public $verifyCode;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return ForgotPassword the static model class
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
		return 'ak_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		// Define all the attribute lengths
				array('password','length','max'=>64, 'min'=>6, 'on'=>'stage3'),
				array('password2','length','max'=>64, 'min'=>6, 'on'=>'stage3'),
				array('email','length','max'=>256, 'on'=>'stage1'),
				array('ip','length','max'=>15),
				array('time', 'numerical', 'integerOnly'=>true),
		
				// make sure email is a valid email
				array('email','email', 'on'=>'stage1'),
		
				// Compare password to repeated password
				array('password', 'compare', 'compareAttribute'=>'password2', 'on'=>'stage3'),
		
				// Setting up when to have what fields.
				array('email', 'required', 'on'=>'stage1'),
				array('password, password2', 'required', 'on'=>'stage3'),
		);
		
	}
	
	
	/**
	 * @return actions to perform before validating
	 */
	public function beforeValidate()
	{
		// store password for sending after registration via email
		$this->emailPassword = $this->password;
		return true;
	}
	
	/**
	 * @return actions to perform before saving ie: hash password
	 */
	public function beforeSave()
	{
		// hash password for database.
		$pass = md5(md5($this->password).Yii::app()->params["@k!MbO"]);
		$this->password = $pass;
		return true;
	}
	
	/**
	 * @return actions to perform after saving ie: Send email with account info
	 */
	public function afterSave()
	{
		/*
		 * This is the Password Change Email setup
		*/
		$subject = "Password Change - Akimbo.com";
		$body = '
		<html>
		<head>
		<title>Akimbo Password Change</title>
		<style>
		body {
		color: #8BB3DA;
	}
	</style>
	</head>
	<body style="background-color: #161616;">
	<div style="margin-left: 10%; margin-top: 5%; background-color: #191919; color: #8BB3DA; width: 600px; overflow: none;">
	<h1>Hello '. $this->email .',</h1><br/><br/>
	
	Your password change request has been complete. YOu need to confirm the request to activate your account
	<br/>
	If you have any troubles an administrator can assist you. Just contact Webmaster@Akimbo.com.<br/><br/>
	
	<table cellspacing="0" cellpadding="0" width="600px">
	<tr><td colspan="2">Account Details</td></tr>
	<tr><td>Username:</td><td>'. $this->email .'</td></tr>
	<tr><td>Password:</td><td>'. $this->emailPassword .'</td></tr>
	<tr><td>Email:</td><td>'. $this->email .'</td></tr>
	
	</table><br/><br/>
	
	Best regards,<br/>
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
		$message->setFrom(array('donotreply@akimbo.com'=>'Akimbo'));
		$message->setSubject($subject);
		$message->setBody($body,$contentType,$charset);
		
		$numsent = Yii::app()->mail->send($message);
	
		// Mailing process
		if($numsent)
		{
			$this->emailed = "Sent";
		}
		else
		{
			// Since the email didn't send, upload it to the mail database table to be sent later.
		
				$this->emailed = "Not Sent";
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
			'userDetails' => array(self::HAS_MANY, 'UserDetails', 'user_id'),
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
			'status' => 'Status',
			'lng' => 'Lng',
			'lat' => 'Lat',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
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
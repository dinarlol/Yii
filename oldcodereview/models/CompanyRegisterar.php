<?php
class CompanyRegisterar extends Person{
	
	
	
	
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
		<div style="margin-left: 10%; margin-top: 5%; background-color: #ffffff; color: #8BB3DA; width: 600px; overflow: none;">
		<h1>Hello '. $this->fullname.',</h1><br/><br/>
	
		Thank you for registering your company at Akimbo. Please confirm your email address by
		<a href="'. $this->validationEmailLink.'"> clicking here</a>
		As a new member to our site
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
		can assist you. Just contact '.Yii::app()->params['adminEmail'].'.<br/><br/>
	
		<table cellspacing="0" cellpadding="0" width="600px">
		<tr><td colspan="2">Account Details</td></tr>
		<tr><td>Username:</td><td>'. $this->email .'</td></tr>
		<tr><td>Password:</td><td>'. $this->getGeneratedPlainPassword() .'</td></tr>
		</table><br/><br/>
	
		Best regards,<br/>
		'.Yii::app()->params['company'].' TEAM
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
				array($this->email=>$this->fullname));
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
				'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
				'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
				'company' => array(self::HAS_ONE, 'Company', 'user_id'),
		);
	}
	
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('email', 'required'),
				array('email', 'email'),
				array('email', 'ext.AkimboValidators.AkimboEmailCheck',
						'message'=>'<div class="errorSummary">A member already exists with the email: <b>{email}</b><br/>
						</div>'
				),
				array('email', 'length', 'max'=>75),
				array('lng, lat', 'length', 'max'=>10),
				array('id, group_id, role_id, email, status, lng, lat, create_date, modified_date', 'safe', 'on'=>'search'),
		);
	}
	
	public function init(){
	
		$criteria = new CDbCriteria();
		$criteria->compare('name', $this->companyRole);
		$rolemodel = Roles::model()->find($criteria);
		$this->role_id = $rolemodel->id;
		$criteria1 = new CDbCriteria();
		$criteria1->compare('name', $this->userGroup);
		$groupmodel = Group::model()->find($criteria1);
		$this->group_id = $groupmodel->id;
		$this->status = $this->pendingstatus;
	
	
	}
	
	public function beforeSave(){
	
		$date = date('Y-m-d H:i:s');
		$this->create_date = $date;
		$this->modified_date = $date;
		return true;
	}
	
	
}

?>
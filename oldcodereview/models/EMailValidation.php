<?php

/**
 * This is the model class for table "ak_validate".
 *
 * The followings are the available columns in table 'ak_validate':
 * @property string $userID
 * @property string $session
 * @property string $password
 * @property string $email
 * @property string $ip
 * @property string $time
 */
class EMailValidation extends CActiveRecord
{
	public $emailed;
	public $sessionLink;
	public $sessionValid;
	public $company_name;
	public $fullname;
	/**
	 * Returns the static model of the specified AR class.
	 * @return EMailValidation the static model class
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
		return 'ak_validate';
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
				
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userID, session, password, email, ip, time', 'safe', 'on'=>'search'),
		);
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
			'session' => 'session',
			'password' => 'Password',
			'email' => 'Email',
			'ip' => 'Ip',
			'time' => 'Time',
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
		$criteria->compare('session',$this->session,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
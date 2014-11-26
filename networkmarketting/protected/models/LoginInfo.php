<?php

/**
 * This is the model class for table "t_login_info".
 *
 * The followings are the available columns in table 't_login_info':
 * @property integer $username_id
 * @property string $username
 * @property string $password
 * @property integer $role_id
 *
 * The followings are the available model relations:
 * @property Role $role
 * @property Users[] $users
 */
class LoginInfo extends CActiveRecord
{
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_login_info';
	}
           	/**
	 * to validate password at login time
	 */
	public function validatePassword($pass)
	{
		//$mypass = md5(md5($pass).Yii::app()->params['salt']);
		//echo "pass is $pass and my pass $mypass this pass is ".$this->password;exit;
		if($this->password == md5($pass.Yii::app()->params["salt"])){

			return true;
		}
		else return false;
	}
	
	protected function beforeSave(){

		$this->plain_password = $this->password;
		$this->password = md5($this->plain_password.Yii::app()->params["salt"]);
		$this->password_repeat =md5($this->password_repeat);

		return true;
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, role_id', 'required'),
			array('role_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>100),
			array('password', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('username_id, username, password, role_id', 'safe', 'on'=>'search'),
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
			'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
			'users' => array(self::HAS_MANY, 'Users', 'username_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username_id' => 'Username',
			'username' => 'Username',
			'password' => 'Password',
			'role_id' => 'Role',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('username_id',$this->username_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LoginInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

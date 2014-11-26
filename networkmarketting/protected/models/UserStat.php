<?php

/**
 * This is the model class for table "t_users".
 *
 * The followings are the available columns in table 't_users':
 * @property integer $user_id
 * @property string $username
 * @property string $full_name
 * @property string $password
 * @property integer $introducer_id
 * @property integer $cnic
 * @property string $dob
 * @property integer $position_id
 * @property integer $gender_id
 * @property string $primary_email
 * @property string $secondry_email
 * @property string $mobile
 * @property integer $country_id
 * @property integer $city_id
 * @property string $address
 * @property integer $security_quest_id
 * @property string $answer
 * @property string $pincode
 * @property string $mother_name
 * @property integer $plan_id
 * @property integer $product_id
 * @property integer $payment_type_id
 * @property string $created_date
 * @property string $modified_date
 * @property integer $role_id
 * @property integer $stage
 * @property integer $parent_id
 * @property integer $left
 * @property integer $right
 *
 * The followings are the available model relations:
 * @property Commission[] $commissions
 * @property Leftrigtbonus[] $leftrigtbonuses
 * @property Leftrigtbonus[] $leftrigtbonuses1
 * @property Leftrigtbonus[] $leftrigtbonuses2
 * @property Redemption[] $redemptions
 * @property Transfer[] $transfers
 * @property Transfer[] $transfers1
 * @property UserMailBoxDrafts[] $userMailBoxDrafts
 * @property UserMailBoxMails[] $userMailBoxMails
 * @property UserMailBoxMails[] $userMailBoxMails1
 * @property City $city
 * @property Country $country
 * @property Gender $gender
 * @property Introducer $introducer
 * @property Payment $paymentType
 * @property Plan $plan
 * @property Position $position
 * @property Product $product
 * @property SecurityInfo $securityQuest
 * @property Userstage[] $userstages
 */
class UserStat extends XcodeModel
{
    
    public $availableBalance;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserStat the static model class
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
		return 't_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, full_name, password, introducer_id, cnic, dob, gender_id, primary_email, secondry_email, mobile, country_id, city_id, address, security_quest_id, answer, pincode, mother_name, plan_id, product_id, payment_type_id, role_id, parent_id', 'required'),
			array('introducer_id, cnic, position_id, gender_id, country_id, city_id, security_quest_id, plan_id, product_id, payment_type_id, role_id, stage, parent_id, left, right', 'numerical', 'integerOnly'=>true),
			array('username, full_name, dob, primary_email, secondry_email, mobile, mother_name', 'length', 'max'=>100),
			array('password', 'length', 'max'=>200),
			array('pincode', 'length', 'max'=>5),
			array('created_date, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, username, full_name, password, introducer_id, cnic, dob, position_id, gender_id, primary_email, secondry_email, mobile, country_id, city_id, address, security_quest_id, answer, pincode, mother_name, plan_id, product_id, payment_type_id, created_date, modified_date, role_id, stage, parent_id, left, right', 'safe', 'on'=>'search'),
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
			'commissions' => array(self::HAS_MANY, 'Commission', 'user_id'),
			'leftrigtbonuses' => array(self::HAS_MANY, 'Leftrigtbonus', 'right_id'),
			'leftrigtbonuses1' => array(self::HAS_MANY, 'Leftrigtbonus', 'left_id'),
			'leftrigtbonuses2' => array(self::HAS_MANY, 'Leftrigtbonus', 'user_id'),
			'redemptions' => array(self::HAS_MANY, 'Redemption', 'user_id'),
			'transfers' => array(self::HAS_MANY, 'Transfer', 'reciever_user_id'),
			'transfers1' => array(self::HAS_MANY, 'Transfer', 'transfer_user_id'),
			'userMailBoxDrafts' => array(self::HAS_MANY, 'UserMailBoxDrafts', 'senderUserId'),
			'userMailBoxMails' => array(self::HAS_MANY, 'UserMailBoxMails', 'receiverUserId'),
			'userMailBoxMails1' => array(self::HAS_MANY, 'UserMailBoxMails', 'senderUserId'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'gender' => array(self::BELONGS_TO, 'Gender', 'gender_id'),
			'introducer' => array(self::BELONGS_TO, 'Introducer', 'introducer_id'),
			'paymentType' => array(self::BELONGS_TO, 'Payment', 'payment_type_id'),
			'plan' => array(self::BELONGS_TO, 'Plan', 'plan_id'),
			'position' => array(self::BELONGS_TO, 'Position', 'position_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'securityQuest' => array(self::BELONGS_TO, 'SecurityInfo', 'security_quest_id'),
			'userstages' => array(self::HAS_MANY, 'Userstage', 'user_id'),
		);
	}
        
        public function withAvailableBalance() {
            
            $sum = Yii::app()->db->createCommand("SELECT SUM(`amounts`) as `sum` FROM `transaction` WHERE 1")->queryScalar();

        $this->getDbCriteria()->mergeWith(array(
            'with' => array(
                'redemptions',
                'commissions',
            ),
                'select' => '*, sum(commissions.points - redemptions.points) as availableBalance',
        ));

        return $this;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'full_name' => 'Full Name',
			'password' => 'Password',
			'introducer_id' => 'Introducer',
			'cnic' => 'Cnic',
			'dob' => 'Dob',
			'position_id' => 'Position',
			'gender_id' => 'Gender',
			'primary_email' => 'Primary Email',
			'secondry_email' => 'Secondry Email',
			'mobile' => 'Mobile',
			'country_id' => 'Country',
			'city_id' => 'City',
			'address' => 'Address',
			'security_quest_id' => 'Security Quest',
			'answer' => 'Answer',
			'pincode' => 'Pincode',
			'mother_name' => 'Mother Name',
			'plan_id' => 'Plan',
			'product_id' => 'Product',
			'payment_type_id' => 'Payment Type',
			'created_date' => 'Created Date',
			'modified_date' => 'Modified Date',
			'role_id' => 'Role',
			'stage' => 'Stage',
			'parent_id' => 'Parent',
			'left' => 'Left',
			'right' => 'Right',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('introducer_id',$this->introducer_id);
		$criteria->compare('cnic',$this->cnic);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('position_id',$this->position_id);
		$criteria->compare('gender_id',$this->gender_id);
		$criteria->compare('primary_email',$this->primary_email,true);
		$criteria->compare('secondry_email',$this->secondry_email,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('security_quest_id',$this->security_quest_id);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('pincode',$this->pincode,true);
		$criteria->compare('mother_name',$this->mother_name,true);
		$criteria->compare('plan_id',$this->plan_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('payment_type_id',$this->payment_type_id);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('stage',$this->stage);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('left',$this->left);
		$criteria->compare('right',$this->right);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
<?php

/**
 * This is the model class for table "t_users".
 *
 * The followings are the available columns in table 't_users':
 * @property integer $user_id
 * @property string $username
 * @property string $full_name
 * @property string $password
 * @property string $password_repeat
 * @property integer $introducer_id
 * @property integer $cnic
 * @property string $dob
 * @property integer $position_id
 * @property integer $lock
 * @property integer $left
 * @property integer $right
 * @property integer $gender_id
 * @property integer $stage
 * @property string $primary_email
 * @property string $secondry_email
 * @property string $mobile
 * @property integer $country_id
 * @property integer $city_id
 * @property string $address
 * @property integer $security_quest_id
 * @property string $answer
 * @property integer $pincode
 * @property string $mother_name
 * @property integer $plan_id
 * @property integer $product_id 
 * @property integer $payment_type_id
 * @property string $created_date
 * @property string $modified_date
 * @property integer $role_id
 * @property integer $parent_id
 * The followings are the available model relations:
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
 */
class Users extends CActiveRecord {

    public $plain_password;
    public $password_repeat;
    public $user_name;
    public $position;
    public $search;
    public $verified_pin;
    public $other_username;
    public $other_pin;
    public $product_size;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_users';
    }

    public function validatePassword($pass) {
        //$mypass = md5(md5($pass).Yii::app()->params['salt']);
        //echo "pass is $pass and my pass $mypass this pass is ".$this->password;exit;
        if ($this->password == md5($pass . Yii::app()->params["salt"])) {

            return true;
        }
        else
            return false;
    }
     public function getTotal() {
            return Yii::app()->db->createCommand("SELECT SUM(`user_id`) as `sum`");
    }

    public function beforeFind() {

        $this->username = strtoupper($this->username);

        return parent::beforeFind();
    }

    protected function beforeSave() {

        if ($this->isNewRecord) {
            if (empty($this->username)) {

                $this->username = UtilityManager::random_username();
            }

            $this->plain_password = $this->password;
            $this->password = md5($this->plain_password . Yii::app()->params["salt"]);
            $this->password_repeat = md5($this->password_repeat);

            return true;
        }
    }

    public static function getUserName($uid) {
        $user = Users::model()->findByPk($uid);
        return $user->username;
    }
    
    
    public static function isUserLock($uid) {
        $user = Users::model()->findByPk($uid);
        return $user->lock;
    }
    
    public static function getFullName($uid) {
        $user = Users::model()->findByPk($uid);
        return $user->full_name;
    }

    // Users::model()->find("username=?", array($_POST['Users']['user_name']))


    public static function getUserIdFromUserName($username) {
        $user = Users::model()->find("username=?", array($username));
        if (!empty($user->user_id))
            return $user->user_id;
    }

    public static function getUserUserFromUserName($username) {
        return Users::model()->find("username=?", array($username));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_id,full_name, password,password_repeat,  cnic, dob, position_id, gender_id, primary_email, secondry_email, mobile, country_id, city_id, address, security_quest_id, answer, pincode, mother_name, plan_id, product_id,  payment_type_id', 'required'),
            array('introducer_id, cnic, position_id, gender_id, country_id, city_id, security_quest_id, pincode, plan_id, product_id,  payment_type_id, role_id', 'numerical', 'integerOnly' => true),
            array('full_name, dob, primary_email, secondry_email, mobile, mother_name', 'length', 'max' => 100),
            array('password_repeat, password', 'required', 'on' => 'create'),
            array('username', 'unique'),
            array('other_username', 'length', 'min' => 6, 'max' => 6),
            array('primary_email', 'email'),
            array('secondry_email', 'email'),
            array('pincode,lock', 'numerical'),
            array('mobile', 'PcSimplePhoneValidator'),
            array('secondry_email', 'email'),
            array('password', 'length', 'min' => 8),
            array('password_repeat', 'length', 'min' => 8),
            array('pincode,other_pin', 'length', 'min' => 4, 'max' => 4),
            array('cnic', 'length', 'min' => 13, 'max' => 16),
            array('password_repeat', 'compare', 'compareAttribute' => 'password'),
            array('created_date, modified_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id,product_size,user_name,parent_id, left,right,parent_id,username, full_name, password, introducer_id, cnic, dob, position_id, gender_id, primary_email, secondry_email, mobile, country_id, city_id, address, security_quest_id, answer, pincode, mother_name, plan_id, product_id,  payment_type_id, created_date, modified_date, role_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
            'userMailBoxDrafts' => array(self::HAS_MANY, 'UserMailBoxDrafts', 'senderUserId'),
            'userMailBoxMails' => array(self::HAS_MANY, 'UserMailBoxMails', 'receiverUserId'),
            'userMailBoxMails1' => array(self::HAS_MANY, 'UserMailBoxMails', 'senderUserId'),
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
            'gender' => array(self::BELONGS_TO, 'Gender', 'gender_id'),
            'introducer' => array(self::BELONGS_TO, 'Users', 'introducer_id'),
            'parent' => array(self::BELONGS_TO, 'Users', 'parent_id'),
            'leftchild' => array(self::BELONGS_TO, 'Users', 'left'),
            'rightchild' => array(self::BELONGS_TO, 'Users', 'right'),
            'paymentType' => array(self::BELONGS_TO, 'Payment', 'payment_type_id'),
            'plan' => array(self::BELONGS_TO, 'Plan', 'plan_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
            'securityQuest' => array(self::BELONGS_TO, 'SecurityInfo', 'security_quest_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => 'User',
            'user_name' => 'Introducer',
            'username' => 'Username',
            'full_name' => 'Full Name',
            'password' => 'Password',
            'password_repeat,' => 'Confirm Password',
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
            'role_id' => 'Role ID',
            "verified_pin" => "Verification Pin Code",
            "other_username" => "Charge from User",
            "other_pin" => "Pin Code",
             "product_size" => "Size",
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('introducer_id', $this->introducer_id);
        $criteria->compare('cnic', $this->cnic);
        $criteria->compare('dob', $this->dob, true);
        $criteria->compare('position_id', $this->position_id);
        $criteria->compare('gender_id', $this->gender_id);
        $criteria->compare('primary_email', $this->primary_email, true);
        $criteria->compare('secondry_email', $this->secondry_email, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('security_quest_id', $this->security_quest_id);
        $criteria->compare('answer', $this->answer, true);
        $criteria->compare('pincode', $this->pincode);
        $criteria->compare('mother_name', $this->mother_name, true);
        $criteria->compare('plan_id', $this->plan_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('payment_type_id', $this->payment_type_id);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('modified_date', $this->modified_date, true);
        $criteria->compare('role_id', $this->role_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeDelete() {

        return false;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}

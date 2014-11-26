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

 * @property integer $left

 * @property integer $right

 * @property integer $gender_id

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
 * 
 * @property integer $lock

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
class Account extends CActiveRecord {
    
    
    public $verified_pin;
    public $product_size;
    public $product_name;
	public $password_repeat;
	public $other_pin;

    /**

     * @return string the associated database table name

     */
    public function tableName() {

        return 't_users';
    }

    /**

     * @return array validation rules for model attributes.

     */
    public function rules() {

        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.

        return array(
            array('username', 'required'),
            array('primary_email', 'email'),
            array('lock', 'numerical'),
            array('verified_pin', 'length', 'max' => 8),
            array('created_date,product_name, modified_date', 'safe'),
            array('mobile', 'PcSimplePhoneValidator'),
            array('password', 'length', 'min' => 8),
            array('password_repeat', 'length', 'min' => 8),
            array('pincode,other_pin', 'length', 'min' => 4, 'max' => 4),
           // array('cnic', 'length', 'min' => 13, 'max' => 16),
           // array('password_repeat', 'compare', 'compareAttribute' => 'password'),
           
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id,product_size,verified_pin,user_name,parent_id, left,right,parent_id,username, full_name, password, introducer_id, cnic, dob, position_id, gender_id, primary_email, secondry_email, mobile, country_id, city_id, address, security_quest_id, answer, pincode, mother_name, plan_id, product_id,  payment_type_id, created_date, modified_date, role_id', 'safe', 'on' => 'search'),
        );
    }

    public function beforeSave() {


	if(isset($this->password_repeat)){
            $this->password_repeat = $this->password;
            $this->password = md5($this->password_repeat . Yii::app()->params["salt"]);
            $this->password_repeat = md5($this->password_repeat);
}
        $this->modified_date = UtilityManager::getSqlCurrentDate();

        return parent::beforeSave();
    }

    /**

     * @return array relational rules.

     */
    public function relations() {

        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.

        return array(
            'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
            'parent' => array(self::BELONGS_TO, 'Users', 'parent_id'),
            'leftchild' => array(self::BELONGS_TO, 'Users', 'left'),
            'rightchild' => array(self::BELONGS_TO, 'Users', 'right'),
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



        $criteria->compare('role_id', $this->role_id);



        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
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


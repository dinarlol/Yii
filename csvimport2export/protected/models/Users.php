<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $date_modified
 * @property string $user_id
 * @property string $password
 * @property string $name
 * @property string $attn
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $tel
 * @property string $cell
 * @property string $email
 * @property string $tax_id
 */
class Users extends CActiveRecord
{
    public $repeat_password;
    public $new_password;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('password, name, email', 'required'),
            array('date_modified, password, name,  street, city, state, zip, tel, cell, email, tax_id', 'required', 'on'=>'update'),
            array('new_password, repeat_password, password', 'required', 'on'=>' edit'),
             array('attn', 'default', 'value' => '', 'setOnEmpty' => true, 'on' => 'update'),
            array('attn,street, state, city, zip,tel, cell, email', 'default', 'value' => '', 'setOnEmpty' => true, 'on' => 'insert'),
            array('repeat_password', 'compare', 'compareAttribute'=>'new_password',  'on'=>'edit'),
            array('user_id', 'length', 'max'=>55),
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
    
    public function beforeValidate() {
        
        $user = self::model()->findByPk($this->user_id);
        if($user->password !== $this->password){
           $this->addError('password', 'Please enter your current password');
        }
        return parent::beforeValidate();
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'activeInstruments' => array(self::HAS_MANY, 'ActiveInstrument', 'userid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'date_modified' => 'Date Modified',
            'user_id' => 'User',
            'password' => 'Current Password',
            'name' => 'Name',
            'attn' => 'Attn',
            'street' => 'Street',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'tel' => 'Tel',
            'cell' => 'Cell',
            'email' => 'Email',
            'tax_id' => 'Tax I.D. #',
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

        $criteria->compare('date_modified',$this->date_modified,true);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('attn',$this->attn,true);
        $criteria->compare('street',$this->street,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('state',$this->state,true);
        $criteria->compare('zip',$this->zip,true);
        $criteria->compare('tel',$this->tel,true);
        $criteria->compare('cell',$this->cell,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('tax_id',$this->tax_id,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
            return $password == $this->password;
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
            return $password;
		//return CPasswordHelper::hashPassword($password);
	}
}
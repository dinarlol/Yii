<?php

/**
 * This is the model class for table "ak_company_not_looking_to_hire".
 *
 * The followings are the available columns in table 'ak_company_not_looking_to_hire':
 * @property integer $id
 * @property string $company_id
 * @property string $checking_akimbo_talent_pool
 * @property string $looking_to_hire_in_future
 * @property string $looking_to_advertise
 */
class CompanyNotLookingToHire extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CompanyNotLookingToHire the static model class
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
		return 'ak_company_not_looking_to_hire';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, checking_akimbo_talent_pool, looking_to_hire_in_future, looking_to_advertise', 'required'),
			array('company_id', 'length', 'max'=>14),
			array('checking_akimbo_talent_pool, looking_to_hire_in_future, looking_to_advertise', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, checking_akimbo_talent_pool, looking_to_hire_in_future, looking_to_advertise', 'safe', 'on'=>'search'),
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
				'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_id' => 'Company',
			'checking_akimbo_talent_pool' => 'Checking Akimbo Talent Pool',
			'looking_to_hire_in_future' => 'Looking To Hire In Future',
			'looking_to_advertise' => 'Looking To Advertise',
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
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('checking_akimbo_talent_pool',$this->checking_akimbo_talent_pool,true);
		$criteria->compare('looking_to_hire_in_future',$this->looking_to_hire_in_future,true);
		$criteria->compare('looking_to_advertise',$this->looking_to_advertise,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
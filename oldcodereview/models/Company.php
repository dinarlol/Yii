<?php

/**
 * This is the model class for table "ak_company".
 *
 * The followings are the available columns in table 'ak_company':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $industry_id
 * @property integer $range_id
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Industry $industry
 * @property CompanyRanges $range
 * @property CompanyDetail[] $companyDetails
 */
class Company extends AkimboRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Company the static model class
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
		return 'ak_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, industry_id, range_id', 'required'),
			array('user_id, industry_id, range_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			
				
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, industry_id, range_id, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'employer' => array(self::BELONGS_TO, 'Employer', 'user_id'),
			'industry' => array(self::BELONGS_TO, 'Industry', 'industry_id'),
			'range' => array(self::BELONGS_TO, 'CompanyRanges', 'range_id'),
			'companyDetails' => array(self::HAS_ONE, 'CompanyDetail', 'company_id'),
			'companyLookingToHire' => array(self::HAS_ONE, 'CompanyLookingToHire', 'company_id'),
			'companyNotompanyLookingToHire' => array(self::HAS_ONE, 'CompanyNotLookingToHire', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'name' => 'Company Name',
			'industry_id' => 'Industry',
			'range_id' => 'Range',
			'create_date' => 'Member Since',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('industry_id',$this->industry_id);
		$criteria->compare('range_id',$this->range_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
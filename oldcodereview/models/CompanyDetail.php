<?php

/**
 * This is the model class for table "ak_company_detail".
 *
 * The followings are the available columns in table 'ak_company_detail':
 * @property integer $id
 * @property integer $company_id
 * @property string $company_info
 * @property string $description
 * @property string $website_url
 * @property string $email
 * @property string $phone
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $street
 * @property string $zip
 * @property string $create_date
 * @property string $modified_date
 * @property string $logo
 *
 * The followings are the available model relations:
 * @property Company $company
 */
class CompanyDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CompanyDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
public static function getCategoryId(){
		return Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_companyAboutMe)))->id;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_company_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, company_info, country, city, street, create_date, modified_date', 'required'),
			array('company_id', 'numerical', 'integerOnly'=>true),
			array('website_url, email, country, city, state, street', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>20),
			array('zip', 'length', 'max'=>50),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, company_info, description, website_url, email, phone, country, city, state, street, zip, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'photo_uploader' => array(self::HAS_ONE, 'PhotoUploader', 'category_pk_id','condition'=>'category_id='.self::getCategoryId()),
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
			'company_info' => 'Company Info',
			'description' => 'Company Description',
			'website_url' => 'Website Url',
			'email' => 'Email',
			'phone' => 'Phone',
			'country' => 'Country',
			'city' => 'City',
			'state' => 'State',
			'street' => 'Street',
			'zip' => 'Zip',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
			'logo' => 'Logo',
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
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('company_info',$this->company_info,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('website_url',$this->website_url,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
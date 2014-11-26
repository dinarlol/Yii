<?php

/**
 * This is the model class for table "ak_post_job_location".
 *
 * The followings are the available columns in table 'ak_post_job_location':
 * @property integer $id
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $street
 * @property string $zipcode
 * @property integer $job_post_id
 * @property string $latitude
 * @property string $longitude
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property AkPostJob $jobPost
 */
class PostJobLocation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PostJobLocation the static model class
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
		return 'ak_post_job_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country, create_date, modified_date', 'required'),
			array('job_post_id', 'numerical', 'integerOnly'=>true),
			array('country, city, state, street, zipcode, latitude, longitude', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, country, city, state, street, zipcode, job_post_id, latitude, longitude, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'jobPost' => array(self::BELONGS_TO, 'PostJob', 'job_post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'country' => 'Country',
			'city' => 'City',
			'state' => 'State',
			'street' => 'Street',
			'zipcode' => 'Zipcode',
			'job_post_id' => 'Job Post',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'create_date' => 'Create Date',
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
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('job_post_id',$this->job_post_id);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        protected function beforeValidate() {
            $this->create_date = date("Y-m-d H:i:s");
            $this->modified_date = date("Y-m-d H:i:s"); 
            return true;
        }
        
}
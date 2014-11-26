<?php

/**
 * This is the model class for table "ak_user_work_experience".
 *
 * The followings are the available columns in table 'ak_user_work_experience':
 * @property integer $id
 * @property integer $user_id
 * @property string $organization
 * @property integer $sector_id
 * @property string $website_url
 * @property string $start_date
 * @property string $end_date
 * @property string $title
 * @property integer $is_working
 * @property string $create_date
 * @property string $modified_date
 * @property string $job_duty
 *
 * The followings are the available model relations:
 * @property JobSectors $sector
 * @property User $user
 */
class UserWorkExperience extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserWorkExperience the static model class
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
		return 'ak_user_work_experience';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, organization, sector_id, create_date, modified_date, job_duty', 'required'),
			array('user_id, sector_id, is_working', 'numerical', 'integerOnly'=>true),
			array('organization, title', 'length', 'max'=>45),
			array('website_url', 'length', 'max'=>85),
			array('job_duty', 'length', 'max'=>125),
			array('start_date, end_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, organization, sector_id, website_url, start_date, end_date, title, is_working, create_date, modified_date, job_duty', 'safe', 'on'=>'search'),
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
			'sector' => array(self::BELONGS_TO, 'JobSectors', 'sector_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'organization' => 'Company',
			'sector_id' => 'Sector',
			'website_url' => 'Website Url',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'title' => 'Title',
			'is_working' => 'Is Working',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
			'job_duty' => 'Job Duty',
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
		$criteria->compare('organization',$this->organization,true);
		$criteria->compare('sector_id',$this->sector_id);
		$criteria->compare('website_url',$this->website_url,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('is_working',$this->is_working);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('job_duty',$this->job_duty,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
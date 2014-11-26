<?php

/**
 * This is the model class for table "ak_post_job_requirment_optional".
 *
 * The followings are the available columns in table 'ak_post_job_requirment_optional':
 * @property integer $id
 * @property integer $post_job_id
 * @property string $degree_title
 * @property integer $work_permit
 * @property integer $travel_required
 * @property string $job_shift
 * @property integer $age_min
 * @property integer $age_max
 * @property integer $salary_range_id
 * @property integer $currency_id
 * @property string $skills
 * @property string $restrict_text
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property AkCurrency $currency
 * @property AkPostJob $postJob
 * @property AkSalaryRanges $salaryRange
 */
class PostJobRequirmentOptional extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PostJobRequirmentOptional the static model class
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
		return 'ak_post_job_requirment_optional';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_job_id, work_permit, travel_required, age_min, age_max, salary_range_id, currency_id', 'numerical', 'integerOnly'=>true),
			array('degree_title', 'length', 'max'=>45),
			array('job_shift', 'length', 'max'=>7),
			array('skills, restrict_text, create_date, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, post_job_id, degree_title, work_permit, travel_required, job_shift, age_min, age_max, salary_range_id, currency_id, skills, restrict_text, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'currency' => array(self::BELONGS_TO, 'AkCurrency', 'currency_id'),
			'postJob' => array(self::BELONGS_TO, 'AkPostJob', 'post_job_id'),
			'salaryRange' => array(self::BELONGS_TO, 'AkSalaryRanges', 'salary_range_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post_job_id' => 'Post Job',
			'degree_title' => 'Degree Title',
			'work_permit' => 'Work Permit',
			'travel_required' => 'Travel Required',
			'job_shift' => 'Job Shift',
			'age_min' => 'Age Min',
			'age_max' => 'Age Max',
			'salary_range_id' => 'Salary Range',
			'currency_id' => 'Currency',
			'skills' => 'Skills',
			'restrict_text' => 'Restrict Text',
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
		$criteria->compare('post_job_id',$this->post_job_id);
		$criteria->compare('degree_title',$this->degree_title,true);
		$criteria->compare('work_permit',$this->work_permit);
		$criteria->compare('travel_required',$this->travel_required);
		$criteria->compare('job_shift',$this->job_shift,true);
		$criteria->compare('age_min',$this->age_min);
		$criteria->compare('age_max',$this->age_max);
		$criteria->compare('salary_range_id',$this->salary_range_id);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('skills',$this->skills,true);
		$criteria->compare('restrict_text',$this->restrict_text,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
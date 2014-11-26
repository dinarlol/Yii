<?php

/**
 * This is the model class for table "ak_post_job_requirement".
 *
 * The followings are the available columns in table 'ak_post_job_requirement':
 * @property integer $id
 * @property integer $job_post_id
 * @property string $gender
 * @property double $experience
 * @property integer $degree_level_id
 * @property integer $career_level_id
 * @property string $experience_in
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property AkPostJob $jobPost
 * @property AkCareerLevel $careerLevel
 * @property AkDegreeLevel $degreeLevel
 */
class PostJobRequirement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PostJobRequirement the static model class
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
		return 'ak_post_job_requirement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gender, experience_in, create_date, modified_date', 'required'),
			array('job_post_id, degree_level_id, career_level_id', 'numerical', 'integerOnly'=>true),
			array('experience', 'numerical'),
			array('gender', 'length', 'max'=>6),
			array('experience_in', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_post_id, gender, experience, degree_level_id, career_level_id, experience_in, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'careerLevel' => array(self::BELONGS_TO, 'CareerLevel', 'career_level_id'),
			'degreeLevel' => array(self::BELONGS_TO, 'DegreeLevel', 'degree_level_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'job_post_id' => 'Job Post',
			'gender' => 'Gender',
			'experience' => 'Experience',
			'degree_level_id' => 'Degree Level',
			'career_level_id' => 'Career Level',
			'experience_in' => 'Experience In',
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
		$criteria->compare('job_post_id',$this->job_post_id);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('experience',$this->experience);
		$criteria->compare('degree_level_id',$this->degree_level_id);
		$criteria->compare('career_level_id',$this->career_level_id);
		$criteria->compare('experience_in',$this->experience_in,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeValidate() {
            $this->create_date = date("Y-m-d H:i:s"); 
            $this->modified_date = date("Y-m-d H:i:s"); 
            return true;
        }
}
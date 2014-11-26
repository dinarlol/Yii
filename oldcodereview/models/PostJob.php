<?php
/**
 * This is the model class for table "ak_post_job".
 *
 * The followings are the available columns in table 'ak_post_job':
 * @property integer $id
 * @property string $job_title
 * @property integer $employer_id
 * @property integer $job_category_id
 * @property integer $number_of_post
 * @property string $job_publishing_date
 * @property string $job_expiredate
 * @property integer $job_type_id
 * @property string $job_description
 * @property string $job_keywords
 * @property string $status
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property AkUser $employer
 * @property AkJobCategory $jobCategory
 * @property AkJobType $jobType
 * @property AkPostJobLocation[] $akPostJobLocations
 * @property AkPostJobRequirement[] $akPostJobRequirements
 * @property AkPostJobRequirmentOptional[] $akPostJobRequirmentOptionals
 */
class PostJob extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PostJob the static model class
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
		return 'ak_post_job';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_title, employer_id, job_category_id, job_publishing_date, job_expiredate, job_type_id, 
                              job_description, number_of_post,status,create_date, modified_date', 'required'),
			array('employer_id, job_category_id, number_of_post, job_type_id', 'numerical', 'integerOnly'=>true),
			array('job_title', 'length', 'max'=>45),
			array('job_keywords', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
                                            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_title, employer_id, job_category_id, number_of_post, job_publishing_date, job_expiredate, job_type_id, job_description, job_keywords, status, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'employer' => array(self::BELONGS_TO, 'Person', 'employer_id'),
			'jobCategory' => array(self::BELONGS_TO, 'JobCategory', 'job_category_id'),
			'jobType' => array(self::BELONGS_TO, 'JobType', 'job_type_id'),
			'PostJobLocations' => array(self::HAS_MANY, 'PostJobLocation', 'job_post_id'),
			'PostJobRequirement' => array(self::HAS_MANY, 'PostJobRequirement', 'job_post_id'),
			'PostJobRequirmentOptionals' => array(self::HAS_MANY, 'PostJobRequirmentOptional', 'post_job_id'),
			'recommendation' => array(self::HAS_MANY, 'JobRecommendation', 'job_id'),
			'jobStats' => array(self::HAS_ONE, 'JobStats', 'post_job_id'),
			'watchers' => array(self::MANY_MANY, 'Person', 'ak_job_watch(user_id, post_job_id)'),
				
                        

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'job_title' => 'Job Title',
			'employer_id' => 'Employer',
			'job_category_id' => 'Job Category',
			'number_of_post' => 'Number Of Post',
			'job_publishing_date' => 'Job Publishing Date',
			'job_expiredate' => 'Job Expiredate',
			'job_type_id' => 'Job Type',
			'job_description' => 'Job Description',
			'job_keywords' => 'Job Keywords',
                        'status' => 'Status',
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
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('employer_id',$this->employer_id);
		$criteria->compare('job_category_id',$this->job_category_id);
		$criteria->compare('number_of_post',$this->number_of_post);
		$criteria->compare('job_publishing_date',$this->job_publishing_date,true);
		$criteria->compare('job_expiredate',$this->job_expiredate,true);
		$criteria->compare('job_type_id',$this->job_type_id);
		$criteria->compare('job_description',$this->job_description,true);
		$criteria->compare('job_keywords',$this->job_keywords,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        
}
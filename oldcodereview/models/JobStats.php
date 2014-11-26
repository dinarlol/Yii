<?php

/**
 * This is the model class for table "ak_job_stats".
 *
 * The followings are the available columns in table 'ak_job_stats':
 * @property integer $id
 * @property integer $post_job_id
 * @property integer $user_id
 * @property integer $visited
 * @property string $visitdate
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property AkPostJob $postJob
 * @property AkUser $user
 */
class JobStats extends CActiveRecord
{
	
	public $status;
	public $send_message;
	public $deleted_messages = true;
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobStats the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public  function getUserId(){
		return empty($this->id)?0:$this->id;
	
	}
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_job_stats';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_job_id, user_id, visitdate,create_date,application_status', 'required'),
			array('post_job_id, user_id, visited', 'numerical', 'integerOnly'=>true),
                        array('message', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, post_job_id, user_id,application_status , message,visited, visitdate, create_date', 'safe', 'on'=>'search'),
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
			'job' => array(self::BELONGS_TO, 'PostJob', 'post_job_id'),
			'applicant' => array(self::BELONGS_TO, 'Person', 'user_id'),
			'watch' => array(self::HAS_ONE, 'JobWatch', 'post_job_id'),
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
			'user_id' => 'User',
                        'message' => 'Message',
			'visited' => 'Visited',
			'Apply Date' => 'Visitdate',
			'create_date' => 'Create Date',
				'application_status ' => 'Status',
				'status' =>'Status',
				'send_message' => 'Contact',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('application_status',$this->application_status);
        $criteria->compare('message',$this->message);
		$criteria->compare('visited',$this->visited);
		$criteria->compare('visitdate',$this->visitdate,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
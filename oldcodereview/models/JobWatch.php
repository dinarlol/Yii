<?php

/**
 * This is the model class for table "ak_job_watch".
 *
 * The followings are the available columns in table 'ak_job_watch':
 * @property integer $post_job_id
 * @property integer $user_id
 * @property integer $watch
 * @property string $create_date
 * @property string $modified_date
 */
class JobWatch extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobWatch the static model class
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
		return 'ak_job_watch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_job_id, user_id, create_date, modified_date', 'required'),
			array('post_job_id, user_id, watch', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_job_id, user_id, watch, create_date, modified_date', 'safe', 'on'=>'search'),
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
				'user' => array(self::BELONGS_TO, 'Person', 'user_id'),
				
		);
	}
	
	
	public function beforeSave(){
		$exist = JobWatch::exists('user_id=? AND post_job_id=?',array($this->user_id,$this->post_job_id));
		if($exist)
			return false;
		
		return true;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'post_job_id' => 'Post Job',
			'user_id' => 'User',
			'watch' => 'Watch',
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

		$criteria->compare('post_job_id',$this->post_job_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('watch',$this->watch);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
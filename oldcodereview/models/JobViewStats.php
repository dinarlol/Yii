<?php

/**
 * This is the model class for table "ak_job_view_stats".
 *
 * The followings are the available columns in table 'ak_job_view_stats':
 * @property integer $id
 * @property integer $job_post_id
 * @property integer $visitor_id
 * @property string $visitdate
 *
 * The followings are the available model relations:
 * @property AkPostJob $jobPost
 * @property AkUser $visitor
 */
class JobViewStats extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobViewStats the static model class
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
		return 'ak_job_view_stats';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_post_id, visitor_id, visitdate', 'required'),
			array('job_post_id, visitor_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_post_id, visitor_id, visitdate', 'safe', 'on'=>'search'),
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
			'visitor' => array(self::BELONGS_TO, 'User', 'visitor_id'),
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
			'visitor_id' => 'Visitor',
			'visitdate' => 'Visitdate',
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
		$criteria->compare('visitor_id',$this->visitor_id);
		$criteria->compare('visitdate',$this->visitdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
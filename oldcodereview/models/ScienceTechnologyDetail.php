<?php

/**
 * This is the model class for table "ak_science_technology_detail".
 *
 * The followings are the available columns in table 'ak_science_technology_detail':
 * @property integer $id
 * @property integer $st_id
 * @property string $project_url
 * @property string $scientist_name
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property ScienceTechnology $st
 */
class ScienceTechnologyDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ScienceTechnologyDetail the static model class
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
		return 'ak_science_technology_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('st_id, create_date, modified_date', 'required'),
			array('st_id', 'numerical', 'integerOnly'=>true),
			array('project_url', 'length', 'max'=>100),
			array('scientist_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, st_id, project_url, scientist_name, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'st' => array(self::BELONGS_TO, 'ScienceTechnology', 'st_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'st_id' => 'St',
			'project_url' => 'Project Url',
			'scientist_name' => 'Scientist Name',
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
		$criteria->compare('st_id',$this->st_id);
		$criteria->compare('project_url',$this->project_url,true);
		$criteria->compare('scientist_name',$this->scientist_name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
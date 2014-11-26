<?php

/**
 * This is the model class for table "ak_company_ranges".
 *
 * The followings are the available columns in table 'ak_company_ranges':
 * @property integer $id
 * @property integer $from
 * @property integer $to
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property Company[] $companys
 */
class CompanyRanges extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CompanyRanges the static model class
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
		return 'ak_company_ranges';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('range, create_date', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, range, create_date', 'safe', 'on'=>'search'),
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
			'companys' => array(self::HAS_MANY, 'Company', 'range_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'range' => 'Company Range',
			'create_date' => 'Create Date',
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
		$criteria->compare('range',$this->range);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
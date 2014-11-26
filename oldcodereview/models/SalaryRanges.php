<?php

/**
 * This is the model class for table "ak_salary_ranges".
 *
 * The followings are the available columns in table 'ak_salary_ranges':
 * @property integer $id
 * @property double $min_salary
 * @property double $max_salary
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property AkPostJobRequirmentOptional[] $akPostJobRequirmentOptionals
 */
class SalaryRanges extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SalaryRanges the static model class
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
		return 'ak_salary_ranges';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('min_salary, max_salary, create_date, modified_date', 'required'),
			array('min_salary, max_salary', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, min_salary, max_salary, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'akPostJobRequirmentOptionals' => array(self::HAS_MANY, 'AkPostJobRequirmentOptional', 'salary_range_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'min_salary' => 'Min Salary',
			'max_salary' => 'Max Salary',
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
		$criteria->compare('min_salary',$this->min_salary);
		$criteria->compare('max_salary',$this->max_salary);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
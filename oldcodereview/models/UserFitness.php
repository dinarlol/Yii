<?php

/**
 * This is the model class for table "ak_user_fitness".
 *
 * The followings are the available columns in table 'ak_user_fitness':
 * @property integer $id
 * @property integer $user_id
 * @property string $create_date
 * @property string $modified_date
 * @property integer $fitness_detail_id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserFitness extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserFitness the static model class
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
		return 'ak_user_fitness';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, create_date, modified_date, fitness_detail_id', 'required'),
			array('user_id, fitness_detail_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, create_date, modified_date, fitness_detail_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Person', 'user_id'),
			'details' => array(self::HAS_MANY, 'UserFitnessDetails', 'fitness_id'),
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
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
			'fitness_detail_id' => 'Fitness Detail',
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
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('fitness_detail_id',$this->fitness_detail_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
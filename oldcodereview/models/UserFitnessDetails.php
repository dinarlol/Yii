<?php

/**
 * This is the model class for table "ak_user_fitness_details".
 *
 * The followings are the available columns in table 'ak_user_fitness_details':
 * @property integer $id
 * @property integer $fitness_id
 * @property integer $school_team_id
 * @property integer $college_team_id
 * @property integer $other_team_id
 */
class UserFitnessDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserFitnessDetails the static model class
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
		return 'ak_user_fitness_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fitness_id', 'required'),
			array('fitness_id, school_team_id, college_team_id, other_team_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fitness_id, school_team_id, college_team_id, other_team_id', 'safe', 'on'=>'search'),
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
				'userFitness' => array(self::BELONGS_TO, 'UserFitness', 'fitness_id'),
				'schoolTeams' => array(self::HAS_ONE, 'SchoolTeams', 'id'),
				'collegeTeams' => array(self::HAS_ONE, 'CollegeTeams', 'college_id'),
				'otherTeams' => array(self::HAS_ONE, 'OtherTeams', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fitness_id' => 'Fitness',
			'school_team_id' => 'School Team',
			'college_team_id' => 'College Team',
			'other_team_id' => 'Other Team',
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
		$criteria->compare('fitness_id',$this->fitness_id);
		$criteria->compare('school_team_id',$this->school_team_id);
		$criteria->compare('college_team_id',$this->college_team_id);
		$criteria->compare('other_team_id',$this->other_team_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
<?php

/**
 * This is the model class for table "ak_college_teams".
 *
 * The followings are the available columns in table 'ak_college_teams':
 * @property integer $id
 * @property integer $college_id
 * @property string $name
 * @property string $description
 */
class CollegeTeams extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CollegeTeams the static model class
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
		return 'ak_college_teams';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('college_id, name, description', 'required'),
			array('college_id', 'numerical', 'integerOnly'=>true),
			array('name, description', 'length', 'max'=>75),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, college_id, name, description', 'safe', 'on'=>'search'),
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
				'details' => array(self::BELONGS_TO, 'UserFitnessDetails', 'college_team_id'),
				'college' => array(self::HAS_ONE, 'College', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'college_id' => 'College',
			'name' => 'College Team Name',
			'description' => 'College Team Description',
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
		$criteria->compare('college_id',$this->college_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
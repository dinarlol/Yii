<?php

/**
 * This is the model class for table "ak_user_story".
 *
 * The followings are the available columns in table 'ak_user_story':
 * @property integer $id
 * @property integer $user_id
 * @property string $story
 * @property string $quote
 * @property string $inspiration
 * @property string $impact
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserStory extends AkimboRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserStory the static model class
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
		return 'ak_user_story';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, create_date, modified_date', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('story, quote, impact', 'length', 'max'=>145),
			array('inspiration', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, story, quote, inspiration, impact, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'story' => 'Story',
			'quote' => 'Quote',
			'inspiration' => 'Inspiration',
			'impact' => 'Impact',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('story',$this->story,true);
		$criteria->compare('quote',$this->quote,true);
		$criteria->compare('inspiration',$this->inspiration,true);
		$criteria->compare('impact',$this->impact,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
<?php

/**
 * This is the model class for table "ak_user_visual_arts".
 *
 * The followings are the available columns in table 'ak_user_visual_arts':
 * @property integer $id
 * @property string $user_id
 * @property string $visual_arts_form_id
 * @property string $artist_inspired_by_id
 * @property string $create_date
 * @property string $datetime
 */
class UserVisualArts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserVisualArts the static model class
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
		return 'ak_user_visual_arts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, visual_arts_form_id, artist_inspired_by_id, create_date, datetime', 'required'),
			array('user_id, visual_arts_form_id, artist_inspired_by_id', 'length', 'max'=>14),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, visual_arts_form_id, artist_inspired_by_id, create_date, datetime', 'safe', 'on'=>'search'),
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
				'visualArt' => array(self::BELONGS_TO, 'VisualArtsForm', 'visual_arts_form_id'),
				'visualInspiredby' => array(self::BELONGS_TO, 'Artist', 'artist_inspired_by_id'),
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
			'visual_arts_form_id' => 'Visual Arts Form',
			'artist_inspired_by_id' => 'Artist Inspired By',
			'create_date' => 'Create Date',
			'datetime' => 'Datetime',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('visual_arts_form_id',$this->visual_arts_form_id,true);
		$criteria->compare('artist_inspired_by_id',$this->artist_inspired_by_id,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('datetime',$this->datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
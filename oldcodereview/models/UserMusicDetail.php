<?php

/**
 * This is the model class for table "ak_user_music_detail".
 *
 * The followings are the available columns in table 'ak_user_music_detail':
 * @property integer $id
 * @property integer $fk_id
 * @property integer $field_id
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property MusicFields $field
 * @property UserMusic $fk
 */
class UserMusicDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserMusicDetail the static model class
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
		return 'ak_user_music_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('fk_id, field_id, create_date, modified_date', 'required'),
				array('fk_id, field_id', 'numerical', 'integerOnly'=>true),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, fk_id, field_id, create_date, modified_date', 'safe', 'on'=>'search'),
		);
	}

	public static function getCategoryId(){
		return Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_userMusics)))->id;
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'field' => array(self::BELONGS_TO, 'MusicFields', 'field_id'),
				'music' => array(self::BELONGS_TO, 'UserMusic', 'fk_id'),
				'userRecomendation' => array(self::HAS_ONE, 'UserRecomendations', 'category_pk_id','condition'=>'category_id='.self::getCategoryId()),
				'video_uploader' => array(self::HAS_MANY, 'VideoUploader', 'category_pk_id','condition'=>'category_id='.self::getCategoryId()),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'fk_id' => 'Fk',
				'field_id' => 'Field of music',
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
		$criteria->compare('fk_id',$this->fk_id);
		$criteria->compare('field_id',$this->field_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}
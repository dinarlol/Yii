<?php

/**
 * This is the model class for table "ak_user_culinary_arts".
 *
 * The followings are the available columns in table 'ak_user_culinary_arts':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $inspiredby
 * @property string $create_date
 * @property string $modified_date
 * @property integer $destination_id
 */
class UserCulinaryArts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserCulinaryArts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public static function getCategoryId(){
		return Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_culinaryArts)))->id;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_user_culinary_arts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name, inspiredby, create_date, modified_date', 'required'),
			array('destination_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>14),
			array('name, inspiredby', 'length', 'max'=>75),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, inspiredby, create_date, modified_date, destination_id', 'safe', 'on'=>'search'),
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
				'userRecomendation' => array(self::HAS_ONE, 'UserRecomendations', 'category_pk_id','condition'=>'category_id='.self::getCategoryId()),
				'document_uploader' => array(self::HAS_MANY, 'DocumentUploader', 'category_pk_id','condition'=>'category_id='.self::getCategoryId()),
				'photo_uploader' => array(self::HAS_MANY, 'PhotoUploader', 'category_pk_id','condition'=>'category_id='.self::getCategoryId()),
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
			'user_id' => 'User',
			'name' => 'Cuisine',
			'inspiredby' => 'What Chefs Artist Inspired You',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
			'destination_id' => 'Destination',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('inspiredby',$this->inspiredby,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('destination_id',$this->destination_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
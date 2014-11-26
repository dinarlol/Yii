<?php

/**
 * This is the model class for table "ak_category".
 *
 * The followings are the available columns in table 'ak_category':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_date
 * @property string $modified_date
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Category the static model class
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
		return 'ak_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, create_date, modified_date', 'required'),
			array('name', 'length', 'max'=>55),
			array('description', 'length', 'max'=>155),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, create_date, modified_date', 'safe', 'on'=>'search'),
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
				'recomendations' => array(self::HAS_MANY, 'UserRecomendations', 'category_id','index'=>'category_id'),//,array('condition'=>'category_id=1')),
				'document_uploader' => array(self::HAS_MANY, 'DocumentUploader', 'category_id','index'=>'category_id'),
				'photo_uploader' => array(self::HAS_MANY, 'PhotoUploader', 'category_id','index'=>'category_id'),
				'video_uploader' => array(self::HAS_MANY, 'VideoUploader', 'category_id','index'=>'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
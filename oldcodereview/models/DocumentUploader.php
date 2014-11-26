<?php

/**
 * This is the model class for table "ak_document_uploader".
 *
 * The followings are the available columns in table 'ak_document_uploader':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property integer $destination_id
 * @property integer $size
 * @property string $create_date
 * @property string $modified_date
 * @property string $location
 * @property integer $category_id
 * @property integer $category_pk_id
 *
 * The followings are the available model relations:
 * @property Category $category
 */
class DocumentUploader extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DocumentUploader the static model class
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
		return 'ak_document_uploader';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name,  size, create_date, modified_date, location, category_id, category_pk_id', 'required'),
			array('destination_id, size, category_id, category_pk_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>14),
			array('name, location', 'length', 'max'=>75),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, destination_id, size, create_date, modified_date, location, category_id, category_pk_id', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'name' => 'Name',
			'destination_id' => 'Destination',
			'size' => 'Size',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
			'location' => 'Location',
			'category_id' => 'Category',
			'category_pk_id' => 'Category Pk',
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
		$criteria->compare('destination_id',$this->destination_id);
		$criteria->compare('size',$this->size);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('category_pk_id',$this->category_pk_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}